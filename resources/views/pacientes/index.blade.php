@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Lista de Pacientes</h1>

<div class="mb-4 flex justify-between items-center">
    <form method="GET" action="{{ route('pacientes.index') }}" class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Buscar paciente..." 
            class="border rounded p-2"
        >
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Buscar</button>
    </form>
    <a href="{{ route('pacientes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Novo Paciente</a>
</div>

@if($pacientes->isEmpty())
    <p class="text-gray-500">Nenhum paciente encontrado.</p>
@else
    <table class="w-full border-collapse bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nome</th>
                <th class="border px-4 py-2">CPF</th>
                <th class="border px-4 py-2">SUS</th>
                <th class="border px-4 py-2">Telefone</th>
                <th class="border px-4 py-2">Triagem</th>
                <th class="border px-4 py-2">Fila</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                <tr>
                    <td class="border px-4 py-2">{{ $paciente->nome }}</td>
                    <td class="border px-4 py-2">{{ $paciente->cpf }}</td>
                    <td class="border px-4 py-2">{{ $paciente->sus }}</td>
                    <td class="border px-4 py-2">{{ $paciente->telefone }}</td>
                    <td class="border px-4 py-2 text-center">
                        @php
                            $colors = [
                                'vermelho' => 'bg-red-500',
                                'laranja' => 'bg-orange-500',
                                'amarelo' => 'bg-yellow-400',
                                'verde' => 'bg-green-500',
                                'azul' => 'bg-blue-500',
                                '' => 'bg-gray-300'
                            ];
                        @endphp
                        <span class="px-2 py-1 text-white rounded {{ $colors[$paciente->cor] ?? 'bg-gray-300' }}">
                            {{ ucfirst($paciente->cor ?? 'Sem') }}
                        </span>
                    </td>
                    <td class="border px-4 py-2 text-center">
                        {{ $paciente->em_fila ? 'Sim' : 'Não' }}
                    </td>
                    <td class="border px-4 py-2 space-x-2 flex justify-center">
                        <a href="{{ route('pacientes.edit', $paciente) }}" class="bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
                        @if(!$paciente->em_fila)
                            <form action="{{ route('pacientes.fila.adicionar', $paciente) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Adicionar Fila</button>
                            </form>
                        @else
                            <form action="{{ route('pacientes.fila.remover', $paciente) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Remover Fila</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $pacientes->links() }}
    </div>
@endif
@endsection
