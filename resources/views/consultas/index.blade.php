<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Consultas
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-6xl">

            {{-- Consultas Agendadas --}}
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Consultas Agendadas</h3>
                @if($consultasAgendadas->isEmpty())
                    <p class="text-gray-500 text-center">Nenhuma consulta agendada.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                <tr>
                                    <th class="px-4 py-3 text-center">ID</th>
                                    <th class="px-4 py-3 text-center">Paciente</th>
                                    <th class="px-4 py-3 text-center">Médico</th>
                                    <th class="px-4 py-3 text-center">Data/Hora</th>
                                    <th class="px-4 py-3 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultasAgendadas as $consulta)
                                    <tr class="hover:bg-blue-50 dark:hover:bg-blue-800">
                                        <td class="px-4 py-3 text-center">{{ $consulta->id }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->paciente->nome }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->medico->nome }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->data_hora->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('consultas.edit', $consulta) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Editar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            {{-- Consultas Concluídas --}}
            <div>
                <h3 class="text-lg font-semibold mb-4 text-green-600">Histórico de Consultas Concluídas</h3>
                @if($consultasConcluidas->isEmpty())
                    <p class="text-gray-500 text-center">Nenhuma consulta concluída.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                <tr>
                                    <th class="px-4 py-3 text-center">ID</th>
                                    <th class="px-4 py-3 text-center">Paciente</th>
                                    <th class="px-4 py-3 text-center">Médico</th>
                                    <th class="px-4 py-3 text-center">Data/Hora</th>
                                    <th class="px-4 py-3 text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultasConcluidas as $consulta)
                                    <tr class="hover:bg-green-50 dark:hover:bg-green-800">
                                        <td class="px-4 py-3 text-center">{{ $consulta->id }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->paciente->nome }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->medico->nome }}</td>
                                        <td class="px-4 py-3 text-center">{{ $consulta->data_hora->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('consultas.show', $consulta) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Ver Detalhes</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
