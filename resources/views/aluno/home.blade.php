@extends('layouts.main')

@section('title', 'Concurso de Bolsas de Estudo')

@section('content')

	<div class="col-md-12 mb-60">
		<h2>Concursos Abertos</h2>
		@if(count($bolsasAbertas) > 0)
	    	<table class="table-hover table texto">
	    		<thead>
	    			<tr>
	    				<th scope="col" style="width: 90px;">Bolsa</th>
	    				<th scope="col" style="width: 110px;">Inscrições até</th>
	    				<th scope="col" style="width: 110px;">Sorteio</th>
	    				<th scope="col" style="width: 150px;">Participar</th>
					</tr>
	    		</thead>
	    		<tbody >
	    			@foreach($bolsasAbertas as $bolsa)
		    			<tr>
		    				<td scope="row">{{ $bolsa->curso }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->fim) }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->sorteio) }}</td>
		    				<td scope="row">
		    					@if(in_array($bolsa->id, $joined))
		    						Participando
	    						@else
	    							<a href="/join/{{ $bolsa->id }}" title="Participar">Participar</a>
    							@endif
		    				</td>
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

	<div class="col-md-12 ">
		<h2>Concursos Finalizados</h2>
		@if(count($bolsasFechadas) > 0)
	    	<table class="table-hover table texto">
	    		<thead>
	    			<tr>
	    				<th scope="col" style="width: 90px;">Bolsa</th>
	    				<th scope="col" style="width: 110px;">Inscrições até</th>
	    				<th scope="col" style="width: 110px;">Sorteio</th>
	    				<th scope="col" style="width: 150px;">Detalhes</th>
					</tr>
	    		</thead>
	    		<tbody >
	    			@foreach($bolsasFechadas as $bolsa)
		    			<tr>
		    				<td scope="row">{{ $bolsa->curso }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->fim) }}</td>
		    				<td scope="row">{{ trocaDataParaPagina($bolsa->sorteio) }}</td>
		    				<td scope="row"><a href="/bolsa/resultado/{{ $bolsa->id }}" title="Ver resultado">Ver resultado</a></td>
		    			</tr>
	    			@endforeach
	    		</tbody>
	    	</table>
	    @else
	    	<div class="col-md-8 offset-md-1">
	        	<h4>Não existem concursos finalizados no momento</h4>
        	</div>
	    @endif
	</div> 

@endsection