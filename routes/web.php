<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\TriagemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Apresentação
Route::get('/apresentacao', function () {
    return view('apresentacao');
})->middleware(['auth', 'verified'])->name('apresentacao');

// Rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    // Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pacientes (CRUD completo)
    Route::resource('pacientes', PacienteController::class);

    // Rotas extras de fila de pacientes
    Route::get('/fila', [PacienteController::class, 'fila'])->name('pacientes.fila');
    Route::post('/pacientes/{paciente}/fila', [PacienteController::class, 'adicionarFila'])->name('pacientes.fila.adicionar');
    Route::post('/pacientes/{paciente}/fila/remover', [PacienteController::class, 'removerFila'])->name('pacientes.fila.remover');

    // Consultas (CRUD completo)
    Route::resource('consultas', ConsultaController::class);

    // Triagens
    Route::get('/pacientes/{paciente}/triagem', [TriagemController::class, 'create'])->name('triagens.create');
    Route::post('/pacientes/{paciente}/triagem', [TriagemController::class, 'store'])->name('triagens.store');
    Route::get('/pacientes/{paciente}/triagem/show', [TriagemController::class, 'show'])->name('triagens.show');
});

// Rotas de autenticação (Breeze)
require __DIR__.'/auth.php';
