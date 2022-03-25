@extends('layouts.main')

@section('title', 'Enviar Foto')

@section('content')

    <div class="container">
    	<div id="event-create-container" class="col-md-6 offset-3">
			<div class="form-group">
				<h3 class="d-inline-block">Você precisa enviar uma foto para se candidatar</h3>
			</div>

			<form action="/aluno/foto/{{ $idBolsa }}" method="POST" id="form" enctype="multipart/form-data">
				@csrf
				<div class="form-group mt-30">
					<label for="foto">Foto</label>
					<input type="file" class="form-control-file" id="foto" name="foto" required="">
				</div>

				<div class="form-group mt-20">
					<input type="checkbox" class="form-control-file mr-5" id="autorizacao" name="autorizacao" required="">
					<label for="autorizacao">Autorizo o uso da minha foto dentro do sistema</label>
				</div>

				<div class="form-group">
					<input type="submit" value="Enviar" class="btn btn-primary" >
					<a href="/bolsas/alunos" title="Cancelar" class="float-end btn btn-warning inline-block">Cancelar</a>
				</div>
			</form>
		</div>
	</div>

@endsection