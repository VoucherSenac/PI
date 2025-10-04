<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Consultas Cadastradas
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-6xl">

            {{-- Barra de ações --}}
            <div class="mb-4 flex justify-between items-center">
                <form method="GET" action="{{ route('consultas.index') }}" class="flex gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Buscar consulta..."
                        class="border rounded p-2 dark:bg-gray-700 dark:text-gray-200"
                    >
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Buscar
                    </button>
                </form>
                <a href="{{ route('consultas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Nova Consulta
                </a>
            </div>

            @if($consultas->isEmpty())
                <p class="text-gray-500 text-center">Nenhuma consulta cadastrada.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-center">ID</th>
                                <th class="px-4 py-3 text-center">Paciente</th>
                                <th class="px-4 py-3 text-center">Médico</th>
                                <th class="px-4 py-3 text-center">Data/Hora</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultas as $consulta)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-3 text-center">{{ $consulta->id }}</td>
                                    <td class="px-4 py-3 text-center">{{ $consulta->paciente->nome }}</td>
                                    <td class="px-4 py-3 text-center">{{ $consulta->medico->nome }}</td>
                                    <td class="px-4 py-3 text-center">{{ $consulta->data_hora->format('H:i - d/m/Y') }}</td>
                                    <td class="px-4 py-3 text-center">{{ ucfirst($consulta->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script>
        let timeout;
        document.querySelector('input[name="search"]').addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    </script>
</x-app-layout>
