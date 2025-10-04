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
                            <th class="px-4 py-3 text-center">Prioridade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            @php
                                $labels = [
                                    'emergente' => 'Emergente',
                                    'muito urgente'  => 'Muito Urgente',
                                    'urgente'  => 'Urgente',
                                    'pouco urgente'    => 'Pouco Urgente',
                                    'não urgente'     => 'Não Urgente',
                                    ''         => 'Sem classificação'
                                ];
                                $colorClasses = [
                                    'emergente' => 'bg-red-500',
                                    'muito urgente'  => 'bg-orange-500',
                                    'urgente'  => 'bg-yellow-500',
                                    'pouco urgente'    => 'bg-green-500',
                                    'não urgente'     => 'bg-blue-500',
                                    ''         => 'bg-gray-500'
                                ];
                            @endphp
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-center">{{ $paciente->nome }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->consultorio->nome ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2 py-1 rounded text-white {{ $colorClasses[$paciente->cor] ?? 'bg-gray-500' }}">
                                        {{ $labels[$paciente->cor] ?? 'Sem classificação' }}
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

<script>
    // Atualiza a fila automaticamente a cada 5 segundos
    setInterval(() => {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTable = doc.querySelector('tbody');
            const currentTable = document.querySelector('tbody');
            if (newTable && currentTable) {
                currentTable.innerHTML = newTable.innerHTML;
            }
        })
        .catch(error => console.error('Erro ao atualizar a fila:', error));
    }, 5000);
</script>
