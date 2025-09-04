@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Fila de Atendimento</h1>

@if($pacientes->isEmpty())
    <p class="text-gray-500">Nenhum paciente na fila.</p>
@else
    <table class="w-full border-collapse bg-white rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">Nome</th>
                <th class="border px-4 py-2">CPF</th>
                <th class="border px-4 py-2">Telefone</th>
                <th class="border px-4 py-2">Classificação</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
                @php
                    $labels = [
                        'vermelho'=>'Emergente','laranja'=>'Muito Urgente',
                        'amarelo'=>'Urgente','verde'=>'Pouco Urgente',
                        'azul'=>'Não Urgente',''=> 'Sem classificação'
                    ];
                    $colors = [
                        'vermelho'=>'#ef4444','laranja'=>'#f97316','amarelo'=>'#eab308',
                        'verde'=>'#22c55e','azul'=>'#3b82f6',''=>'#6b7280'
                    ];
                @endphp
                <tr>
                    <td class="border px-4 py-2">{{ $paciente->nome }}</td>
                    <td class="border px-4 py-2">{{ $paciente->cpf }}</td>
                    <td class="border px-4 py-2">{{ $paciente->telefone }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-1 rounded text-white" style="background-color: {{ $colors[$paciente->cor] }}">
                            {{ $labels[$paciente->cor] }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
