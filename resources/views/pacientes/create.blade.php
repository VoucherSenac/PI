@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Cadastrar Novo Paciente</h1>

<form action="{{ route('pacientes.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Nome</label>
        <input type="text" name="nome" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">CPF</label>
        <input type="text" name="cpf" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">SUS</label>
        <input type="text" name="sus" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Endereço</label>
        <input type="text" name="endereco" class="border p-2 w-full rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Telefone</label>
        <input type="text" name="telefone" class="border p-2 w-full rounded">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cadastrar</button>
</form>
@endsection
