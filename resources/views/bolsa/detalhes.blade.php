@extends('layouts.main')

@section('title', "Detalhe da Bolsa de $bolsa->curso")

@section('content')  

<div class="col-md-12 mb-60">
	<div>
		<h2 class="inline-flex">Bolsa de {{ $bolsa->curso}}</h2>
		<h2 class="float-end">Status: {{ $bolsa->status }}</h2>
	</div>

	<div class="col">
		@if($sortear)
			<a href="/bolsa/sortear/{{ $bolsa->id }}" title="Sortear" class=" btn btn-default">Sortear</a>
		@endif
		@if($cancelar)
			<a href="/bolsa/cancelar/{{ $bolsa->id }}" title="Cancelar" class=" btn btn-danger">Cancelar Bolsa</a>
		@endif

		<a href="/admin/home" title="Voltar" class="float-end btn btn-warning inline-block">Voltar</a>
	</div>
	<div class="mt-30">
		<ul class="navbar-nav ">
			<li class="search-box">
				<a class="" href="#">Filtrar</a>
				<span> | </span>
				
				<a href="/bolsa/detalhes/{{ $bolsa->id}}" title="Limpar" class="btn-sm">Limpar Filtro</a>

				<form action="/bolsa/detalhes/{{ $bolsa->id }}" id="searchNome" method="POST" class="app-search position-relative">
					@csrf
					<input type="text"class="form-control" name="nome" placeholder="Nome do Aluno" />

					<select class="form-control nac" id="nac" name="nac">
						<option value="" selected >Nacionalidade</option>
						<option value="Brasileiro(a)">Brasileiro(a)</option>
						<option value="Estrangeiro(a)">Estrangeiro(a)</option>
					</select>

					<input type="submit" value="Buscar" class="btn-sm btn-tumblr btn-sub" />
					
				</form>

			</li>
		</ul>

		<h2 class="mt-40">Lista de Inscritos</h2>

		@if(count($alunos) > 0)
			<table class="table-hover table texto text-center mt-40">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">E-mail</th>
						<th scope="col">CPF</th>
						<th scope="col">Nascimento</th>
						<th scope="col">Telefone</th>
						<th scope="col">Nacionalidade</th>
						<th scope="col">Responsável</th>
					</tr>
				</thead>
				<tbody >
					@for($i=0; $i<count($alunos); $i++)
						<tr>  
							<td scope="row">{{ $alunos[$i]->nome }}</td>
							<td scope="row">{{ $alunos[$i]->email }}</td>
							<td scope="row">{{ $alunos[$i]->cpf }}</td>
							<td scope="row">{{ trocaNascParaPagina($alunos[$i]->nascimento)}}</td>
							<td scope="row">{{ $alunos[$i]->fone }}</td>
							<td scope="row">{{ $alunos[$i]->nacionalidade }}</td>
							<td scope="row">{{ $adultos[$i] }}</td>
						</tr>
					@endfor
				</tbody>
			</table>
		@else
	    	<div class="col-md-8 offset-md-1">
	        	<h4>Ainda não existem inscritos nessa Bolsa</h4>
	    	</div>
	    @endif
	</div>
</div>

<script type="text/javascript">
	function submete(id){
		document.getElementById(id).submit();
	}
</script>

@endsection