@extends('layouts.main')

@section('title', 'Cadastrar Admin')

@section('content')
    <main class="signup-form">
	    <div class="cotainer">
	        <div class="row justify-content-center">
	            <div class="col-md-4">
	                <div class="card">
	                    <h3 class="card-header text-center">Cadastrar Admin</h3>
	                    <div class="card-body">
	                        <form action="/admin/register2" method="POST">
	                            @csrf
	                            <div class="form-group mb-3">
	                                <input type="text" placeholder="Email" id="email_address" class="form-control"
	                                    name="email" required autofocus>
	                                @if ($errors->has('email'))
	                                <span class="text-danger">{{ $errors->first('email') }}</span>
	                                @endif
	                            </div>
	                            <div class="form-group mb-3">
	                                <input type="password" placeholder="Password" id="password" class="form-control"
	                                    name="password" required>
	                                @if ($errors->has('password'))
	                                <span class="text-danger">{{ $errors->first('password') }}</span>
	                                @endif
	                            </div>
	                            <div class="d-grid mx-auto">
	                                <button type="submit" class="btn btn-dark btn-block">Salvar</button>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</main>


   @endsection
