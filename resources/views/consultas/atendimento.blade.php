<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Atendimento Médico - ') . $paciente->nome }}
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-6xl">

            {{-- Mensagem de erro --}}
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 shadow-md text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Informações do Paciente --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informações do Paciente</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div><strong>Nome:</strong> {{ $paciente->nome }}</div>
                    <div><strong>CPF:</strong> {{ $paciente->cpf }}</div>
                    <div><strong>SUS:</strong> {{ $paciente->sus }}</div>
                    <div><strong>Data de Nascimento:</strong> {{ $paciente->data_nascimento ? $paciente->data_nascimento->format('d/m/Y') : 'Não informado' }}</div>
                    <div><strong>Telefone:</strong> {{ $paciente->telefone ?: 'Não informado' }}</div>
                    <div><strong>Endereço:</strong> {{ $paciente->endereco ?: 'Não informado' }}</div>
                </div>
            </div>

            {{-- Informações da Triagem --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informações da Triagem</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div><strong>Sintomas:</strong> {{ $triagem->sintomas }}</div>
                    <div><strong>Gravidade:</strong>
                        @php
                            $gravidades = [
                                'vermelho' => 'Emergência',
                                'laranja' => 'Muito Urgente',
                                'amarelo' => 'Urgente',
                                'verde' => 'Pouco Urgente',
                                'azul' => 'Não Urgente'
                            ];
                        @endphp
                        <span class="px-2 py-1 text-white rounded {{ $paciente->cor == 'vermelho' ? 'bg-red-500' : ($paciente->cor == 'laranja' ? 'bg-orange-500' : ($paciente->cor == 'amarelo' ? 'bg-yellow-400' : ($paciente->cor == 'verde' ? 'bg-green-500' : 'bg-blue-500'))) }}">
                            {{ $gravidades[$paciente->cor] ?? 'Não informado' }}
                        </span>
                    </div>
                    <div><strong>Pressão Arterial:</strong> {{ $triagem->pressao_sistolica }}/{{ $triagem->pressao_diastolica }}</div>
                    <div><strong>Frequência Cardíaca:</strong> {{ $triagem->frequencia_cardiaca }} bpm</div>
                    <div><strong>Temperatura:</strong> {{ $triagem->temperatura }} °C</div>
                    <div><strong>Peso:</strong> {{ $triagem->peso }} kg</div>
                    <div><strong>Altura:</strong> {{ $triagem->altura }} m</div>
                    <div><strong>Frequência Respiratória:</strong> {{ $triagem->frequencia_respiratoria }} rpm</div>
                    <div><strong>Observações:</strong> {{ $triagem->observacoes ?: 'Nenhuma' }}</div>
                </div>
            </div>

            {{-- Formulário de Atendimento --}}
            <form action="{{ route('pacientes.atendimento.store', $paciente) }}" method="POST">
                @csrf

                <h3 class="text-lg font-semibold mb-4">Registro de Atendimento</h3>

                {{-- Hipóteses Diagnósticas --}}
                <div class="mb-4">
                    <label for="hipoteses_diagnosticas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hipóteses Diagnósticas Iniciais</label>
                    <textarea id="hipoteses_diagnosticas" name="hipoteses_diagnosticas" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                              placeholder="Digite as hipóteses diagnósticas..."></textarea>
                </div>

                {{-- Condição Física na Avaliação Inicial --}}
                <div class="mb-4">
                    <label for="condicao_fisica" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Condição Física na Avaliação Inicial</label>
                    <textarea id="condicao_fisica" name="condicao_fisica" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                              placeholder="Descreva a condição física do paciente..."></textarea>
                </div>



                {{-- Exames Necessários --}}
                <div class="mb-4">
                    <label for="exames_necessarios" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exames Necessários</label>
                    <textarea id="exames_necessarios" name="exames_necessarios" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                              placeholder="Liste os exames necessários..."></textarea>
                </div>

                {{-- Medicamentos Receitados --}}
                <div class="mb-4">
                    <label for="medicamentos_receitados" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Medicamentos Receitados</label>
                    <textarea id="medicamentos_receitados" name="medicamentos_receitados" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                              placeholder="Liste os medicamentos receitados..."></textarea>
                </div>

                {{-- Observações do Atendimento --}}
                <div class="mb-4">
                    <label for="observacoes_atendimento" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observações do Atendimento</label>
                    <textarea id="observacoes_atendimento" name="observacoes_atendimento" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-200"
                              placeholder="Observações adicionais do atendimento..."></textarea>
                </div>

                {{-- Botões --}}
                <div class="flex justify-end gap-4">
                    <a href="{{ route('pacientes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Finalizar Atendimento
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
