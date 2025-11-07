<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalhes do Paciente: ') . $paciente->nome }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-4xl">

            {{-- Informações básicas --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Informações Básicas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->nome }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->cpf }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data de Nascimento</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->data_nascimento ? \Carbon\Carbon::parse($paciente->data_nascimento)->format('d/m/Y') : 'Não informado' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Idade</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->data_nascimento ? \Carbon\Carbon::parse($paciente->data_nascimento)->age . ' anos' : 'Não informado' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">SUS</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->sus ?: 'Não informado' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefone</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->telefone ?: 'Não informado' }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Endereço</label>
                    <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->endereco ?: 'Não informado' }}</p>
                </div>
            </div>

            {{-- Status --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border-l-4 border-blue-400 mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Status</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Em Fila</label>
                        <span class="px-2 py-1 rounded text-white {{ $paciente->em_fila ? 'bg-green-500' : 'bg-gray-500' }}">
                            {{ $paciente->em_fila ? 'Sim' : 'Não' }}
                        </span>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gravidade</label>
                        <span class="px-2 py-1 rounded text-white {{ $paciente->cor ? 'bg-' . ($paciente->cor == 'vermelho' ? 'red' : ($paciente->cor == 'laranja' ? 'orange' : ($paciente->cor == 'amarelo' ? 'yellow' : ($paciente->cor == 'verde' ? 'green' : 'blue')))) . '-500' : 'bg-gray-500' }}">
                            {{ $paciente->cor ?: 'Não definida' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Última Triagem --}}
            @if($paciente->triagens()->exists())
                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border-l-4 border-green-400 mb-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Última Triagem</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Realizada em {{ $paciente->triagens()->latest()->first()->created_at->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('triagens.show', [$paciente, $paciente->triagens()->latest()->first()]) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        Ver Triagem
                    </a>
                </div>
            @else
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border-l-4 border-yellow-400 mb-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Triagem</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Este paciente ainda não possui triagem.</p>
                    <a href="{{ route('triagens.create', $paciente) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Realizar Triagem
                    </a>
                </div>
            @endif

            {{-- Botões --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('pacientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Voltar
                </a>
                <a href="{{ route('pacientes.edit', $paciente) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Editar
                </a>
                @if(!$paciente->em_fila && $paciente->triagens()->exists())
                    <a href="{{ route('consultas.atendimento', $paciente) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Atendimento
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
