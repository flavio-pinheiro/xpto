<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Aluno;
use App\Models\Adulto;
use App\Models\Bolsa;
use App\Http\Requests\AlunoCadastraPerfil;


class AlunoController extends Controller
{
    public function index(){
    	
    	//Verifica se o aluno tem perfil cadastrado
        $aluno_id = null;

        $emailUser = auth()->user()->email; 

    	$aluno = Aluno::where('email','=',$emailUser)->get();

    	foreach ($aluno as $value) { 
    		$aluno_id    = $value->id;
            $nascimento  = $value->nascimento;
            $adulto_id   = $value->adulto_id;
    	}

    	if(!$aluno_id){
    		return redirect('/aluno/perfil');
    	}

        //Verifica se o aluno é menor de idade e tem perfil de adulto cadastrado
        if( (verificaMaioridade($nascimento) <= '18') && (!$adulto_id) ){
            return redirect('/adulto/perfil');
        }

        if(session('msg')){
            return redirect('/bolsas/alunos')->with('msg', session('msg'));
        }

        return redirect('/bolsas/alunos');
    }

    public function perfil(){
    	$id = auth()->user()->id;
    	$emailUser = auth()->user()->email;  

    	return view('aluno/cadastraPerfil', ['id' => $id, 'emailUser' => $emailUser]);
    }

    public function store(AlunoCadastraPerfil $request, $id){ 
        

    	$aluno = new Aluno;

    	$aluno->nome          = $request->nome;
    	$aluno->email         = $request->email;
    	$aluno->cpf           = $request->cpf;
    	$aluno->nascimento    = $request->nascimento;
    	$aluno->fone          = $request->fone;
    	$aluno->nacionalidade = $request->nacionalidade;
        $aluno->autorizacao   = $request->autorizacao;

        //Upload de Imagem
        if ( $request->hasFile('foto') && $request->file('foto')->isValid() ){ 
            if (!$request->autorizacao){
                return redirect('/aluno/perfil')->with('msg', 'É necessário autorizar o uso da foto');
            }

            $requestFoto = $request->foto;

            $extension = $requestFoto->extension();

            $fotoName = rand(1000, 9999) .'_'. strtotime('now') . '.' . $extension;

            $requestFoto->move(public_path('/img/alunos'), $fotoName);

            $aluno->foto = $fotoName;
        } 

        $aluno->user_id = $id;

    	$aluno->save();

    	return redirect('/aluno/home')->with('msg', 'Perfil atualizado com sucesso!');
    }


    public function salvaAdultoEmAluno($adulto_id){ 
        $emailUser = auth()->user()->email;
        Aluno::where('email', $emailUser)->update(['adulto_id' => $adulto_id]);
    }

    public function joinBolsa($id){ 
        $emailUser = auth()->user()->email;

        $aluno = Aluno::where('email','=',$emailUser)->first();

        if ($aluno->foto == null){
            return view('aluno/uploadFoto', ['idBolsa' => $id]);
        }
        
        $aluno->bolsas()->attach($id);

        $msg = 'Você se cadastrou com sucesso!';

        return redirect('/aluno/home')->with('msg', $msg);
    }

    public function uploadFoto(Request $request, $idBolsa){
        if (!$request->autorizacao){
            return view('aluno/uploadFoto', ['idBolsa' => $idBolsa])->with('msg', 'É necessário autorizar o uso da foto');
        }

        if ( !$request->hasFile('foto') && !$request->file('foto')->isValid() ){ 
            return view('aluno/uploadFoto', ['idBolsa' => $idBolsa])->with('msg', 'A foto precisa ser inserida ou é inválida');

        } 
             
        $data = $request->all(); 

        $requestFoto = $request->foto;

        $extension = $requestFoto->extension();

        $fotoName = rand(1000, 9999) .'_'. strtotime('now') . '.' . $extension;

        $requestFoto->move(public_path('/img/alunos'), $fotoName);

        $data['foto'] = $fotoName;

        $emailUser = auth()->user()->email;

        $aluno = Aluno::where('email','=',$emailUser)->first();

        Aluno::findOrFail($aluno->id)->update($data);

        $idAluno = $aluno->id;

        return redirect("/join/$idBolsa");
        
    }

}
