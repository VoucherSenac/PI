<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalhes da Consulta
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full mx-auto max-w-4xl">

            {{-- Informações Básicas --}}
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-4">Informações da Consulta</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>ID:</strong> {{ $consulta->id }}</div>
                    <div><strong>Status:</strong>
                        <span class="px-2 py-1 text-white rounded {{ $consulta->status == 'concluida' ? 'bg-green-500' : ($consulta->status == 'agendada' ? 'bg-blue-500' : 'bg-red-500') }}">
                            {{ ucfirst($consulta->status) }}
                        </span>
                    </div>
                    <div><strong>Data/Hora:</strong> {{ $consulta->data_hora->format('d/m/Y H:i') }}</div>
                    <div><strong>Paciente:</strong> {{ $consulta->paciente->nome }}</div>
                    <div><strong>Médico:</strong> {{ $consulta->medico->nome }}</div>
                </div>
            </div>

            {{-- Observações --}}
            @if($consulta->observacoes)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Observações</h3>
                    <p class="text-gray-700 dark:text-gray-300">{{ $consulta->observacoes }}</p>
                </div>
            @endif

            {{-- Detalhes do Atendimento (apenas para consultas concluídas) --}}
            @if($consulta->status == 'concluida')
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Detalhes do Atendimento</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Hipóteses Diagnósticas --}}
                        @if($consulta->hipoteses_diagnosticas)
                            <div>
                                <h4 class="font-medium mb-2">Hipóteses Diagnósticas</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $consulta->hipoteses_diagnosticas }}</p>
                            </div>
                        @endif

                        {{-- Condição Física --}}
                        @if($consulta->condicao_fisica)
                            <div>
                                <h4 class="font-medium mb-2">Condição Física na Avaliação</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $consulta->condicao_fisica }}</p>
                            </div>
                        @endif

                        {{-- Exames Necessários --}}
                        @if($consulta->exames_necessarios)
                            <div>
                                <h4 class="font-medium mb-2">Exames Necessários</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $consulta->exames_necessarios }}</p>
                            </div>
                        @endif

                        {{-- Medicamentos Receitados --}}
                        @if($consulta->medicamentos_receitados)
                            <div>
                                <h4 class="font-medium mb-2">Medicamentos Receitados</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $consulta->medicamentos_receitados }}</p>
                            </div>
                        @endif

                        {{-- Observações do Atendimento --}}
                        @if($consulta->observacoes_atendimento)
                            <div class="md:col-span-2">
                                <h4 class="font-medium mb-2">Observações do Atendimento</h4>
                                <p class="text-gray-700 dark:text-gray-300">{{ $consulta->observacoes_atendimento }}</p>
                            </div>
                        @endif

                    </div>
                </div>
            @endif

            {{-- Botão Voltar --}}
            <div class="flex justify-end">
                <a href="{{ route('consultas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
