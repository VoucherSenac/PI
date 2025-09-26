<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('consultas', ConsultaController::class);


// CRUD de pacientes
Route::resource('pacientes', PacienteController::class)->except(['destroy']);

// Rotas de fila
Route::get('/fila', [PacienteController::class, 'fila'])->name('pacientes.fila');
Route::post('/pacientes/{paciente}/fila', [PacienteController::class, 'adicionarFila'])->name('pacientes.fila.adicionar');
Route::post('/pacientes/{paciente}/fila/remover', [PacienteController::class, 'removerFila'])->name('pacientes.fila.remover');
