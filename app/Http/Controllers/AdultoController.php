<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Adulto;
use \App\Models\Aluno;
use App\Http\Requests\AdultoCadastraPerfil;


class AdultoController extends Controller
{
    public function index(){
    	return view('adulto/cadastraPerfil');
    }

    public function store(AdultoCadastraPerfil $request){ 

    	$adulto = new Adulto;

    	$adulto->nome          = $request->nome;
    	$adulto->email         = $request->email;
    	$adulto->cpf           = $request->cpf;
    	$adulto->nascimento    = $request->nascimento;
    	$adulto->fone          = $request->fone;
    	$adulto->nacionalidade = $request->nacionalidade;
    	$adulto->parentesco    = $request->parentesco;
    	
        //Valida se Adulto é maior
        if (verificaMaioridade($adulto->nascimento) < 18) {
            return redirect('/adulto/perfil')->with('msg', 'É necessário que o adulto responsável seja maior de idade');
         } 

    	$adulto->save();

    	//Grava FK de adulto em aluno
    	$adulto_id = $this->buscaIdPeloCpf($adulto->cpf);

    	$emailUser = auth()->user()->email;

    	Aluno::where('email', $emailUser)->update(['adulto_id' => $adulto_id]);

    	return redirect('/aluno/home')->with('msg', 'Perfil de responsável adicionado com sucesso!');;
    }


    public function buscaIdPeloCpf($cpf){
    	$adulto = Adulto::where('cpf', '=', $cpf)->get();

    	foreach ($adulto as $value) {
    		$id = $value->id;
    	}

    	return $id;
	}

}


