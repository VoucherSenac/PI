<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Pacientes') }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-6xl">

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 shadow-md text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Barra de ações --}}
        <div class="mb-4 flex justify-between items-center">
            <form method="GET" action="{{ route('pacientes.index') }}" class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar paciente..."
                    class="border rounded p-2 dark:bg-gray-700 dark:text-gray-200"
                >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Buscar
                </button>
            </form>
            <a href="{{ route('pacientes.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Novo Paciente
            </a>
        </div>

        {{-- Lista de pacientes --}}
        @if($pacientes->isEmpty())
            <p class="text-gray-500 text-center">Nenhum paciente encontrado.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full ">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        <tr>
                            <th class=" px-4 py-3 text-center">Nome</th>
                            <th class=" px-4 py-3 text-center">CPF</th>
                            <th class=" px-4 py-3 text-center">SUS</th>
                            <th class=" px-4 py-3 text-center">Telefone</th>
                            <th class=" px-4 py-3 text-center">Triagem</th>
                            <th class=" px-4 py-3 text-center">Fila</th>
                            <th class=" px-4 py-3 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pacientes as $paciente)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 text-center">{{ $paciente->nome }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->cpf }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->sus }}</td>
                                <td class="px-4 py-3 text-center">{{ $paciente->telefone }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="cor" onchange="this.form.submit()" class="border border-gray-300 dark:border-gray-700 p-1 rounded text-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">--</option>
                                            <option value="emergente" {{ $paciente->cor == 'emergente' ? 'selected' : '' }}>Emergente</option>
                                            <option value="muito urgente" {{ $paciente->cor == 'muito urgente' ? 'selected' : '' }}>Muito Urgente</option>
                                            <option value="urgente" {{ $paciente->cor == 'urgente' ? 'selected' : '' }}>Urgente</option>
                                            <option value="pouco urgente" {{ $paciente->cor == 'pouco urgente' ? 'selected' : '' }}>Pouco Urgente</option>
                                            <option value="não urgente" {{ $paciente->cor == 'não urgente' ? 'selected' : '' }}>Não Urgente</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    {{ $paciente->em_fila ? 'Sim' : 'Não' }}
                                </td>
                                <td class="px-4 py-3 flex justify-center gap-2">
                                    <a href="{{ route('pacientes.edit', $paciente) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                        Editar
                                    </a>
                                    @if(!$paciente->em_fila)
                                        <form action="{{ route('pacientes.fila.adicionar', $paciente) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                                Adicionar Fila
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('pacientes.fila.remover', $paciente) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                Remover Fila
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Paginação --}}
                <div class="mt-4">
                    {{ $pacientes->links() }}
                </div>
            </div>
        @endif
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
