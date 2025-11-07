<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Triagem de ') . $paciente->nome }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-4xl">

            {{-- Informações básicas do paciente --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Informações Básicas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $paciente->nome }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Idade</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ \Carbon\Carbon::parse($paciente->data_nascimento)->age }} anos</p>
                    </div>
                </div>
            </div>

            {{-- Queixa principal --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Queixa Principal</label>
                <p class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-200">{{ $triagem->queixa_principal }}</p>
            </div>

            {{-- Histórico de doenças --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Histórico de Doenças</label>
                <p class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-200">{{ $triagem->historico_doencas ?: 'Não informado' }}</p>
            </div>

            {{-- Alergias --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alergias</label>
                <p class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-200">{{ $triagem->alergias ?: 'Não informado' }}</p>
            </div>

            {{-- Hábitos --}}
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Hábitos</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-900 dark:text-gray-300 mr-2">Fuma:</span>
                        <span class="px-2 py-1 rounded text-white {{ $triagem->fuma ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ $triagem->fuma ? 'Sim' : 'Não' }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-sm text-gray-900 dark:text-gray-300 mr-2">Consome bebidas alcoólicas:</span>
                        <span class="px-2 py-1 rounded text-white {{ $triagem->bebe ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ $triagem->bebe ? 'Sim' : 'Não' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Medicamentos em uso --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicamentos em Uso</label>
                <p class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-200">{{ $triagem->medicamentos_uso ?: 'Não informado' }}</p>
            </div>

            {{-- Sinais Vitais --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border-l-4 border-blue-400 mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Sinais Vitais</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pressão Arterial</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->pressao_sistolica ?: 'Não informado' }}/{{ $triagem->pressao_diastolica ?: 'Não informado' }} mmHg</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Frequência Cardíaca</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->frequencia_cardiaca ?: 'Não informado' }} bpm</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Temperatura</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->temperatura ?: 'Não informado' }} °C</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peso</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->peso ?: 'Não informado' }} kg</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Altura</label>
                        <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->altura ?: 'Não informado' }} m</p>
                    </div>
                </div>
            </div>

            {{-- Gravidade --}}
            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border-l-4 border-yellow-400 mb-6">
                <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Gravidade</h3>
                <form action="{{ route('triagens.update', [$paciente, $triagem]) }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('PUT')
                    <select name="gravidade" class="border border-gray-300 dark:border-gray-700 p-2 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="vermelho" {{ $triagem->gravidade == 'vermelho' ? 'selected' : '' }}>Emergente</option>
                        <option value="laranja" {{ $triagem->gravidade == 'laranja' ? 'selected' : '' }}>Muito Urgente</option>
                        <option value="amarelo" {{ $triagem->gravidade == 'amarelo' ? 'selected' : '' }}>Urgente</option>
                        <option value="verde" {{ $triagem->gravidade == 'verde' ? 'selected' : '' }}>Pouco Urgente</option>
                        <option value="azul" {{ $triagem->gravidade == 'azul' ? 'selected' : '' }}>Não Urgente</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Atualizar Gravidade</button>
                </form>
            </div>

            {{-- Data da triagem --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data da Triagem</label>
                <p class="mt-1 text-gray-900 dark:text-gray-200">{{ $triagem->created_at->format('d/m/Y H:i') }}</p>
            </div>

            {{-- Botões --}}
            <div class="flex justify-end space-x-4">
                <a href="{{ route('pacientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Voltar
                </a>
                <a href="{{ route('triagens.create', $paciente) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Nova Triagem
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
