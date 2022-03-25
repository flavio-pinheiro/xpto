<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bolsa;
use App\Models\Aluno;
use App\Models\Adulto;
use DateTime;
use App\Http\Requests\CadastraBolsa;

class BolsaController extends Controller
{
    public function bolsasViewAlunos(){
    	$bolsasAbertas = Bolsa::where('status', 'Abertas')->get();
    	$bolsasFechadas = Bolsa::where('status', 'Finalizado')->get();

    	$emailUser = auth()->user()->email;

        $aluno = Aluno::where('email','=',$emailUser)->first();

    	$participando = $aluno->bolsas;

    	$joined = [];

    	foreach ($participando as $participa) {
			array_push($joined, $participa->pivot->bolsa_id);
    	}

    	return view('aluno/home', ['bolsasAbertas' => $bolsasAbertas, 'bolsasFechadas' => $bolsasFechadas, 'joined' => $joined]);
    }

    public function verResultado($id){
    	$bolsa = Bolsa::where('id', $id)->first();

    	$nomeBolsa = $bolsa->curso;

    	$vencedores = [];

    	foreach ($bolsa->vencedores as $vencedor) {
		 	$dados = Aluno::where('id', $vencedor)->first();

		 	$idade = verificaMaioridade($dados->nascimento);

		 	array_push($vencedores,  ['nome' => $dados->nome, 'idade' => $idade]);
    	} 

    	return view('bolsa/resultado', ['vencedores' => $vencedores, 'nomeBolsa' => $nomeBolsa]);
    }

    public function bolsasViewAdmin(){
        $bolsas = Bolsa::get();

        return view('admin/home', ['bolsas' => $bolsas]);
    }

    public function readBolsa($id, Request $request){  
        //Detalhes da Bolsa
        $bolsa = Bolsa::where('id', $id)->first(); 

        $inscritos = $bolsa->alunos()->get();

        if ( ($bolsa->status == 'Abertas') && (count($inscritos) > 0) ){
            $sortear = true;
        }else{
            $sortear = false;
        }

        if ($bolsa->status <> 'Cancelado') {
            $cancelar = true;
        }else{
            $cancelar = false;
        }

        if ($request == null) {
            //Detalhes dos Inscritos
            $inscritos = $bolsa->alunos()->get();
        }else{
            $nome = $request->nome; 
            $nac = $request->nac;

            $inscritos = Aluno::join('aluno_bolsa', 'alunos.id', '=', 'aluno_bolsa.aluno_id')
                ->where('aluno_bolsa.bolsa_id', $id)
                ->where('alunos.nome', 'like', '%'.$nome.'%')
                ->where('alunos.nacionalidade', 'like', '%'.$nac.'%')
                ->get(['alunos.*']);
        }
        

        $alunos = [];
        $adultos = [];

        foreach ($inscritos as $inscrito) {
            $aluno = Aluno::where('id', $inscrito->id)->first(); 
            array_push($alunos, $aluno);
            
            //Nome do Adulto Responsável 
            if ($aluno->adulto_id) {
                $adulto = Adulto::where('id',$aluno->adulto_id)->first();
                $nomeAdulto = $adulto->nome;
                array_push($adultos, $nomeAdulto);
            }else{
                array_push($adultos, '-');
            }
        }

        return view('bolsa/detalhes', ['bolsa' => $bolsa, 'sortear' => $sortear, 'cancelar' => $cancelar, 'alunos' => $alunos, 'adultos', 'adultos' => $adultos]);
    }

    public function sortear($id){
        $bolsa = Bolsa::where('id', $id)->first();

        $inscritos = $bolsa->alunos()->get();

        $arr_idInscritos = [];
        $arr_idSorteados = [];

        foreach ($inscritos as $inscrito) {
            array_push($arr_idInscritos, $inscrito['id']);  
        }

        if (count($inscritos) <= $bolsa->vagas){
            for ($i=0; $i<count($inscritos); $i++){
                array_push($arr_idSorteados, $arr_idInscritos[$i]);
            }
        }else{
            for ($i=0; $i<$bolsa->vagas; $i++) {
                $key = rand(0, count($arr_idInscritos) - 1);
                
                array_push($arr_idSorteados, $arr_idInscritos[$key]);
                
                unset($arr_idInscritos[$key]);

                $arr_idInscritos = array_values($arr_idInscritos); //Reindexação do Array
            }
        }

        Bolsa::where('id', $id)->update(['vencedores' => $arr_idSorteados, 'status' => 'Finalizado']);

        return redirect('/bolsa/detalhes/'.$id)->with('msg', 'Sorteio realizado com sucesso');

    }

    public function cancelarBolsa($id){
        Bolsa::where('id', $id)->update(['status' => 'Cancelado']);

        return redirect('/bolsa/detalhes/'.$id)->with('msg', 'Sorteio cancelado com sucesso');
    }

    public function filtrar(Request $request, $id){ 
        $nome = $request->nome; 
        $nac = $request->nac;

        //Detalhes da Bolsa para cancelar e sortear
        $bolsa = Bolsa::where('id', $id)->first();

        if ($bolsa->status == 'Abertas') {
            $sortear = true;
        }else{
            $sortear = false;
        }

        if ($bolsa->status <> 'Cancelado') {
            $cancelar = true;
        }else{
            $cancelar = false;
        }
        
        $inscritos = Aluno::join('aluno_bolsa', 'alunos.id', '=', 'aluno_bolsa.aluno_id')
                ->where('aluno_bolsa.bolsa_id', $id)
                ->where('alunos.nome', 'like', '%'.$nome.'%')
                ->where('alunos.nacionalidade', 'like', '%'.$nac.'%')
                ->get(['alunos.*']);

        $alunos = []; 
        $adultos = []; 

        foreach ($inscritos as $inscrito) {
            $aluno = Aluno::where('id', $inscrito->id)->first(); 
            array_push($alunos, $aluno);
            
            //Nome do Adulto Responsável 
            if ($aluno->adulto_id) {
                $adulto = Adulto::where('id',$aluno->adulto_id)->first();
                $nomeAdulto = $adulto->nome;
                array_push($adultos, $nomeAdulto);
            }else{
                array_push($adultos, '-');
            }
        } 

        return view("bolsa/detalhes", ['bolsa' => $bolsa, 'sortear' => $sortear, 'cancelar' => $cancelar, 'alunos' => $alunos, 'adultos', 'adultos' => $adultos]);
    }

    public function create(){
        return view('bolsa/cadastraBolsa');
    }

    public function store(CadastraBolsa $request){
        date_default_timezone_set('America/Sao_Paulo');
        $time = new DateTime();

        $bolsa = new Bolsa;

        $bolsa->curso       = $request->curso;
        $bolsa->vagas       = $request->vagas;
        $bolsa->fim         = $request->fim.' '.$request->horaFim;
        $bolsa->sorteio     = $request->sorteio.' '.$request->horaSorteio;
        
        $bolsa->inicio = $time->format('Y-m-d H:i:s'); 
        $bolsa->status = 'Abertas';

        $teste = strtotime($bolsa->sorteio);

        //Valida se a data do fim é maior que a do início
        if (   strtotime($bolsa->fim) <= strtotime($bolsa->inicio) ){
            return redirect ('bolsa/create')->with('msg', 'A data-hora do fim das inscrições não pode ser menor que o início das inscrições, que é o momento desse cadastro');
        }

        if (   strtotime($bolsa->sorteio) <= strtotime($bolsa->fim) ){
            return redirect('bolsa/create')->with('msg', 'A data-hora do sorteio não pode ser menor que o fim das inscrições');
        }

        $bolsa->save();

        return redirect('/bolsas/admin')->with('msg', 'Bolsa criada com sucesso!');
    }

    public function vencedores($id){
        $bolsa = Bolsa::where('id', $id)->first();
        $idVencedores = $bolsa->vencedores;

        for($i=0; $i<count($idVencedores); $i++){
            $aluno = Aluno::where('id', $idVencedores[$i])->first();
            $vencedores[$i]['nome'] = $aluno->nome;
            $vencedores[$i]['foto'] = '/img/alunos/'.$aluno->foto;
        }

        $totInscritos = count($bolsa->alunos()->get());

        $vagas = $bolsa->vagas;

        $relacao = round(($totInscritos / $vagas), 2);

        $nomeBolsa = $bolsa->curso;

        return view('bolsa/vencedores', 
            [
                'nomeBolsa' => $nomeBolsa, 
                'vencedores' => $vencedores, 
                'totInscritos' => $totInscritos, 
                'vagas' => $vagas, 
                'relacao' => $relacao
            ]
        );
    }
 

}
