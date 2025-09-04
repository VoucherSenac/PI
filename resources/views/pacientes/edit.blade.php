@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Editar Paciente</h1>

<form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block mb-1">Nome</label>
        <input type="text" name="nome" value="{{ old('nome', $paciente->nome) }}" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">CPF</label>
        <input type="text" name="cpf" value="{{ old('cpf', $paciente->cpf) }}" class="border p-2 w-full rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Telefone</label>
        <input type="text" name="telefone" value="{{ old('telefone', $paciente->telefone) }}" class="border p-2 w-full rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Endereço</label>
        <input type="text" name="endereco" value="{{ old('endereco', $paciente->endereco) }}" class="border p-2 w-full rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Triagem</label>
        <select name="cor" class="border p-2 w-full rounded">
            <option value="">--</option>
            <option value="vermelho" {{ $paciente->cor == 'vermelho' ? 'selected' : '' }}>Emergente</option>
            <option value="laranja" {{ $paciente->cor == 'laranja' ? 'selected' : '' }}>Muito Urgente</option>
            <option value="amarelo" {{ $paciente->cor == 'amarelo' ? 'selected' : '' }}>Urgente</option>
            <option value="verde" {{ $paciente->cor == 'verde' ? 'selected' : '' }}>Pouco Urgente</option>
            <option value="azul" {{ $paciente->cor == 'azul' ? 'selected' : '' }}>Não Urgente</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
</form>
@endsection
