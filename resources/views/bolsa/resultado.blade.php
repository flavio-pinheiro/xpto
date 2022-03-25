@extends('layouts.main')

@section('title', "Resultado do Sorteio de $nomeBolsa")

@section('content') 

	<div id="" class="col-md-12 container mt-40">
		
		<h1 class="inline-flex">Resultado do sorteio de {{ $nomeBolsa }}</h1>

		<a href="/bolsas/alunos" class="btn btn-warning float-end" >Voltar</a>

        <div class="container">
           <table class="table-hover table texto mt-40">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                    </tr>
                </thead>
                <tbody >
                    @for($i=0; $i<count($vencedores); $i++)
                        <tr>  
                            <td scope="row">{{ $vencedores[$i]['nome'] }}</td>
                            <td scope="row">{{ $vencedores[$i]['idade'] }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>

@endsection