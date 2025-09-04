<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

Route::get('/', function () {
    return view('welcome');
});

// CRUD de pacientes
Route::resource('pacientes', PacienteController::class)->except(['destroy']);

// Rotas de fila
Route::get('/fila', [PacienteController::class, 'fila'])->name('pacientes.fila');
Route::post('/pacientes/{paciente}/fila', [PacienteController::class, 'adicionarFila'])->name('pacientes.fila.adicionar');
Route::post('/pacientes/{paciente}/fila/remover', [PacienteController::class, 'removerFila'])->name('pacientes.fila.remover');
