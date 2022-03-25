<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdultoController;
use App\Http\Controllers\BolsaController;

Route::get('/', [LoginController::class, 'index'])->middleware('auth');

//SuperAdm
Route::middleware(['auth', 'isSuperAdm'])->group(function () {
	Route::get('/admin/register2', [AdminController::class, 'register']);
	Route::post('/admin/register2', [AdminController::class, 'registration']);
});

//Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
	Route::get('/admin/home', [AdminController::class, 'index']);
	Route::get('/admin/perfil', [AdminController::class, 'perfil']);
	Route::post('/admin/perfil/{id}', [AdminController::class, 'store']);
	Route::get('/bolsas/admin', [BolsaController::class, 'bolsasViewAdmin']);
	Route::get('/bolsa/detalhes/{id}', [BolsaController::class, 'readBolsa']);
	Route::post('/bolsa/detalhes/{id}', [BolsaController::class, 'readBolsa']);
	Route::get('/bolsa/sortear/{id}', [BolsaController::class, 'sortear']);
	Route::get('/bolsa/cancelar/{id}', [BolsaController::class, 'cancelarBolsa']);
	Route::post('/bolsa/filtro/{id}', [BolsaController::class, 'filtrar']);
	Route::get('/bolsa/create', [BolsaController::class, 'create']);
	Route::post('/bolsa', [BolsaController::class, 'store']);
	Route::get('/bolsa/vencedores/{id}', [BolsaController::class, 'vencedores']);
});

//Aluno
Route::middleware(['auth', 'isNotAdmin'])->group(function () {
	Route::get('/aluno/home', [AlunoController::class, 'index']);
	Route::get('/aluno/perfil', [AlunoController::class, 'perfil']);
	Route::post('/aluno/perfil/{id}', [AlunoController::class, 'store']);
	Route::get('/adulto/perfil', [AdultoController::class, 'index']);
	Route::post('/adulto/perfil', [AdultoController::class, 'store']);
	Route::get('/join/{id}', [AlunoController::class, 'joinBolsa']);
	Route::get('/bolsas/alunos', [BolsaController::class, 'bolsasViewAlunos']);
	Route::get('/bolsa/resultado/{id}', [BolsaController::class, 'verResultado']);
	Route::get('/bolsa/vencedores', [BolsaController::class, 'verResultado']);
	Route::post('/aluno/foto/{idBolsa}', [AlunoController::class, 'uploadFoto']);

});


Route::redirect('/forgot-password', '/');
Route::redirect('/reset-password', '/');
Route::redirect('/confirm-password', '/');
Route::redirect('/verify-email', '/');
