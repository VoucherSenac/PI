<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Consultas Cadastradas
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6 overflow-x-auto">
            @if($consultas->isEmpty())
                <p class="text-gray-500 text-center">Nenhuma consulta cadastrada.</p>
            @else
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        <tr>
                            <th class="border px-4 py-2 text-center">ID</th>
                            <th class="border px-4 py-2 text-center">Paciente</th>
                            <th class="border px-4 py-2 text-center">Médico</th>
                            <th class="border px-4 py-2 text-center">Data/Hora</th>
                            <th class="border px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultas as $consulta)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 text-center">
                                <td class="border px-4 py-2">{{ $consulta->id }}</td>
                                <td class="border px-4 py-2">{{ $consulta->paciente->nome }}</td>
                                <td class="border px-4 py-2">{{ $consulta->medico->nome }}</td>
                                <td class="border px-4 py-2">{{ $consulta->data_hora }}</td>
                                <td class="border px-4 py-2">{{ ucfirst($consulta->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
