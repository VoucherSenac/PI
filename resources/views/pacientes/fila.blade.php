<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Fila de Atendimento') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-6xl">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 shadow-md text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($pacientes->isEmpty())
            <p class="text-gray-500 text-center">Nenhum paciente na fila.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-center">Nome</th>
                            <th class="px-4 py-3 text-center">Consultório</th>
                            <th class="px-4 py-3 text-center">Doutor</th>
                            <th class="px-4 py-3 text-center">Classificação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            @php
                                $labels = [
                                    'vermelho' => 'Emergente',
                                    'laranja'  => 'Muito Urgente',
                                    'amarelo'  => 'Urgente',
                                    'verde'    => 'Pouco Urgente',
                                    'azul'     => 'Não Urgente',
                                    ''         => 'Não triado'
                                ];
                                $colorClasses = [
                                    'vermelho' => 'bg-red-500',
                                    'laranja'  => 'bg-orange-500',
                                    'amarelo'  => 'bg-yellow-500',
                                    'verde'    => 'bg-green-500',
                                    'azul'     => 'bg-blue-500',
                                    ''         => 'bg-gray-500'
                                ];
                            @endphp
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-center">{{ $paciente->nome }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->ultimaTriagem->consultorio->numero ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->ultimaTriagem->consultorio->doutor ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 rounded text-white {{ $colorClasses[$paciente->cor] }}">
                                        {{ $labels[$paciente->cor] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $pacientes instanceof \Illuminate\Pagination\LengthAwarePaginator ? $pacientes->links() : '' }}
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
