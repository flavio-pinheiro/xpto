@extends('layouts.main')

@section('title', 'Configurar Perfil Responsável')

@section('content')

	<div class="container">
		<div id="event-create-container" class="col-md-6 offset-3">
			<div class="form-group">
				<h1 class="d-inline-block">Configurar Perfil de Responsável</h1>
				<p class="obg">* Campos obrigatorios</p>
			</div>

			<form action="/adulto/perfil" method="post" id="form" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="nome">Nome Completo<span class="obg"> *</span></label>
					<input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome">
					@error('nome')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="email">E-mail<span class="obg"> *</span></label>
					<input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"> 
					@error('email')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="cpf">CPF<span class="obg"> *</span></label>
					<input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf">
					@error('cpf')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="nascimento">Nascimento<span class="obg"> *</span></label>
					<input type="date" class="form-control @error('nascimento') is-invalid @enderror" id="nascimento" name="nascimento">
					@error('nascimento')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="fone">Telefone<span class="obg"> *</span></label>
					<input type="text" class="form-control @error('fone') is-invalid @enderror" id="fone" name="fone">
					@error('fone')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="nacionalidade">Nacionalidade<span class="obg"> *</span></label>
					<select class="form-control @error('nacionalidade') is-invalid @enderror" id="nacionalidade" name="nacionalidade">
						<option disabled="" selected>Escolha</option>
						<option value="Brasileiro(a)">Brasileiro(a)</option>
						<option value="Estrangeiro(a)">Estrangeiro(a)</option>
					</select>
					@error('nacionalidade')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="parentesco">Grau de Parentesco<span class="obg"> *</span></label>
					<select class="form-control @error('parentesco') is-invalid @enderror" id="parentesco" name="parentesco">
						<option disabled="" selected>Escolha</option>
						<option value="Mãe">Mãe</option>
						<option value="Pai">Pai</option>
						<option value="Outros">Outros</option>
					</select>
					@error('parentesco')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<input type="submit" value="Salvar" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>

@endsection