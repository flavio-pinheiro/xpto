@extends('layouts.main')

@section('title', 'Administração de Bolsas')

@section('content')

	<div class="col-md-12 mb-120">
		<h2 class="inline-flex">Administração de Bolsas</h2>
		<a href="/bolsa/create" class="btn btn-default float-end">Nova Bolsa</a>
		@if(count($bolsas) > 0)
	    	<table class="table-hover table texto text-center">
	    		<thead>
	    			<tr>
	    				<th scope="col">Bolsa</th>
	    				<th scope="col">Início</th>
	    				<th scope="col">Fim</th>
	    				<th scope="col">Sorteio</th>
	    				<th scope="col">Dias p/ Sorteio</th>
	    				<th scope="col">Vagas</th>
	    				<th scope="col">Qtd Inscritos</th>
	    				<th scope="col">Status</th>
	    				<th scope="col">Detalhes</th>
	    				<th scope="col">Vencedores</th>
					</tr>
	    		</thead>
	    		<tbody >
	    			@foreach($bolsas as $bolsa) 
		    			<tr>
		    				<td scope="row">{{ $bolsa->curso }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->inicio) }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->fim) }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->sorteio) }}</td>
		    				<td scope="row">
		    					@if( ($bolsa->status == 'Cancelado') || ($bolsa->status == 'Finalizado') )
		    						-		    							
		    					@else
		    						{{ subtracaoDeDatas($bolsa->sorteio) }}
		    					@endif
		    				<td scope="row">{{ ($bolsa->vagas) }}</td>
		    				<td scope="row">
	    						@php
	    							$inscritos = $bolsa->alunos()->get();
		    						echo count($inscritos);
	    						@endphp
		    				</td>
		    				<td scope="row">
		    					@if( (ajustaStatus($bolsa->fim, $bolsa->sorteio) && $bolsa->status == 'Abertas') )
		    						{{ 'Aguardando Sorteio' }}
	    						@else
			    					{{ ($bolsa->status) }}
		    					@endif
		    				</td>
		    				<td scope="row"><a href="/bolsa/detalhes/{{ $bolsa->id }}" title="Detalhes">Detalhes</a></td>
		    				@if($bolsa->status == 'Finalizado')
		    					<td><a href="/bolsa/vencedores/{{ $bolsa->id }}" title="Vencedores">Vencedores</a></td>
	    					@else
	    						<td>-</td>
    						@endif
		    			</tr>
	    			@endforeach
	    		</tbody>
	    	</table>
	    @else
	    	<div class="col-md-8 offset-md-1">
	        	<h4>Não existem concursos abertos no momento</h4>
        	</div>
	    @endif
	</div>


@endsection