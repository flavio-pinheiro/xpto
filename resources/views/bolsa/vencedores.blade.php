@extends('layouts.main')

@section('title', "Vencedores da bolsa de $nomeBolsa")

@section('content') 

	<div id="vencedores-container" class="col-md-12 container mt-20">
		
		<h1 class="inline-flex">Vencedores da Bolsa de {{ $nomeBolsa }}</h1>

		<a href="/bolsas/admin" class="btn btn-warning float-end" >Voltar</a>

        <h3 class="mt-30">Total de Inscritos: {{ $totInscritos }}</h3>

        <h4 class="mt-20 mb-60">Concorrência: {{ $relacao }} candidatos por vaga</h4>

        <div class="container">
            @foreach($vencedores as $key => $vencedor)
                <div class="row">
                    <div class="col">
                        <img class="inline-block mb-0" src="{{ URL::asset($vencedor['foto']) }}">
                        <h5 class="inline-block h5-1-venc">{{ $vencedor['nome'] }}</h5>
                    </div>
                </div>
                <hr class="hr-1-venc">
            @endforeach
        </div>
    </div>

@endsection
