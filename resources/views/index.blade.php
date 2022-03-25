@extends('layouts/main')

@section('title', 'Xpto')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h1 class="card-title mb-0">Bolsões</h1>
				<a href="/create" class="btn btn-primary" id="btn-1">Novo Bolsão</a>
			
				<table class="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">First</th>
							<th scope="col">Last</th>
							<th scope="col">Handle</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">1</th>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<th scope="row">2</th>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<th scope="row">3</th>
							<td>Larry</td>
							<td>the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
@endsection