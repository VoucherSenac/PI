<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Triagem de Paciente: ') . $paciente->nome }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-4xl">

            {{-- Mensagem de erro --}}
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 shadow-md">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('triagens.store', $paciente) }}" method="POST" class="space-y-6">
                @csrf

                {{-- Informações básicas do paciente --}}
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Informações Básicas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input type="text" value="{{ $paciente->nome }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 dark:bg-gray-600 dark:text-gray-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Idade</label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($paciente->data_nascimento)->age }} anos" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 dark:bg-gray-600 dark:text-gray-200">
                        </div>
                    </div>
                </div>

                {{-- Queixa principal --}}
                <div>
                    <label for="queixa_principal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Queixa Principal *</label>
                    <textarea id="queixa_principal" name="queixa_principal" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Descreva a queixa principal do paciente..." required></textarea>
                </div>

                {{-- Histórico de doenças --}}
                <div>
                    <label for="historico_doencas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Histórico de Doenças</label>
                    <textarea id="historico_doencas" name="historico_doencas" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Liste doenças pré-existentes, cirurgias, etc."></textarea>
                </div>

                {{-- Alergias --}}
                <div>
                    <label for="alergias" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alergias</label>
                    <textarea id="alergias" name="alergias" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Liste alergias conhecidas (medicamentos, alimentos, etc.)"></textarea>
                </div>

                {{-- Hábitos --}}
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Hábitos</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input id="fuma" name="fuma" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                            <label for="fuma" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Fuma</label>
                        </div>
                        <div class="flex items-center">
                            <input id="bebe" name="bebe" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600">
                            <label for="bebe" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Consome bebidas alcoólicas</label>
                        </div>
                    </div>
                </div>

                {{-- Medicamentos em uso --}}
                <div>
                    <label for="medicamentos_uso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicamentos em Uso</label>
                    <textarea id="medicamentos_uso" name="medicamentos_uso" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Liste medicamentos atualmente em uso"></textarea>
                </div>

                {{-- Gravidade --}}
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border-l-4 border-yellow-400">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800 dark:text-gray-200">Gravidade *</h3>
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <input type="radio" id="vermelho" name="gravidade" value="vermelho" class="sr-only peer" required>
                            <label for="vermelho" class="flex items-center justify-center p-4 bg-red-500 text-white rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-red-500 peer-checked:ring-offset-2 hover:bg-red-600 transition-colors">
                                <span class="font-semibold">Vermelho</span>
                            </label>
                            <p class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400">Emergência</p>
                        </div>
                        <div>
                            <input type="radio" id="laranja" name="gravidade" value="laranja" class="sr-only peer">
                            <label for="laranja" class="flex items-center justify-center p-4 bg-orange-500 text-white rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-orange-500 peer-checked:ring-offset-2 hover:bg-orange-600 transition-colors">
                                <span class="font-semibold">Laranja</span>
                            </label>
                            <p class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400">Muito Urgente</p>
                        </div>
                        <div>
                            <input type="radio" id="amarelo" name="gravidade" value="amarelo" class="sr-only peer">
                            <label for="amarelo" class="flex items-center justify-center p-4 bg-yellow-500 text-white rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-yellow-500 peer-checked:ring-offset-2 hover:bg-yellow-600 transition-colors">
                                <span class="font-semibold">Amarelo</span>
                            </label>
                            <p class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400">Urgente</p>
                        </div>
                        <div>
                            <input type="radio" id="verde" name="gravidade" value="verde" class="sr-only peer">
                            <label for="verde" class="flex items-center justify-center p-4 bg-green-500 text-white rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-green-500 peer-checked:ring-offset-2 hover:bg-green-600 transition-colors">
                                <span class="font-semibold">Verde</span>
                            </label>
                            <p class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400">Pouco Urgente</p>
                        </div>
                        <div>
                            <input type="radio" id="azul" name="gravidade" value="azul" class="sr-only peer">
                            <label for="azul" class="flex items-center justify-center p-4 bg-blue-500 text-white rounded-lg cursor-pointer peer-checked:ring-2 peer-checked:ring-blue-500 peer-checked:ring-offset-2 hover:bg-blue-600 transition-colors">
                                <span class="font-semibold">Azul</span>
                            </label>
                            <p class="text-xs text-center mt-1 text-gray-600 dark:text-gray-400">Não Urgente</p>
                        </div>
                    </div>
                </div>

                {{-- Consultório --}}
                <div>
                    <label for="consultorio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Consultório</label>
                    <select id="consultorio_id" name="consultorio_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                        <option value="">Selecione um consultório (opcional)</option>
                        @foreach($consultorios as $consultorio)
                            <option value="{{ $consultorio->id }}">{{ $consultorio->numero }} - {{ $consultorio->doutor }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Botões --}}
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('pacientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Salvar Triagem
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
