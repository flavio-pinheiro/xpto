@extends('layouts.main')

@section('title', 'Nova Bolsa')

@section('content')

	<div class="container">
		<div class="col-md-6 offset-3">
			<div class="form-group">
				<h1 class="d-inline-block">Nova Bolsa</h1>
				<p class="obg">* Campos obrigatorios</p>
			</div>

			<form action="/bolsa" method="POST" id="form">
				@csrf
				<div class="form-group">
					<label for="curso">Curso<span class="obg"> *</span></label>
					<input type="text" class="form-control @error('curso') is-invalid @enderror" id="curso" name="curso">
					@error('curso')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="vagas">Número de Vagas</label> 
					<input type="number" class="form-control @error('vagas') is-invalid @enderror" id="vagas" name="vagas" value="5">
					@error('vagas')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="fim">Data do fim das Inscrições<span class="obg"> *</span></label>
					<input type="date" class="form-control @error('fim') is-invalid @enderror" id="fim" name="fim">
					@error('fim')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="horaFim">Hora do fim das Inscrições<span class="obg"> *</span></label>
					<input type="time" class="form-control @error('horaFim') is-invalid @enderror" id="horaFim" name="horaFim">
					@error('horaFim')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="sorteio">Data do Sorteio<span class="obg"> *</span></label>
					<input type="date" class="form-control @error('sorteio') is-invalid @enderror" id="sorteio" name="sorteio">
					@error('sorteio')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<label for="horaSorteio">Hora do Sorteio<span class="obg"> *</span></label>
					<input type="time" class="form-control @error('horaSorteio') is-invalid @enderror" id="horaSorteio" name="horaSorteio">
					@error('horaSorteio')
						<div class="invalid-feedback">
							{{ $message }}
						</div>
					@enderror
				</div>

				<div class="form-group">
					<input type="submit" value="Salvar" class="btn btn-primary" >
					<a href="/admin/home" title="Voltar" class="float-end btn btn-warning inline-block">Voltar</a>
				</div>
			</form>
		</div>
	</div>

@endsection