<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Paciente') }}
        </h2>
    </x-slot>

    <div class="py-6 flex items-center justify-center bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-2xl">
            <form action="{{ route('pacientes.update', $paciente) }}" method="POST" class="w-full">
                @csrf
                @method('PUT')

                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Edite as Informações do Paciente</h3>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                    <input type="text" name="nome" value="{{ old('nome', $paciente->nome) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                    <input type="text" name="cpf" value="{{ old('cpf', $paciente->cpf) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" value="{{ old('data_nascimento', $paciente->data_nascimento ? $paciente->data_nascimento->format('Y-m-d') : '') }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Telefone</label>
                    <input type="text" name="telefone" value="{{ old('telefone', $paciente->telefone) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Endereço</label>
                    <input type="text" name="endereco" value="{{ old('endereco', $paciente->endereco) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Consultório</label>
                    <input type="text" name="consultorio" value="{{ old('consultorio', $paciente->consultorio) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Doutor</label>
                    <input type="text" name="doutor" value="{{ old('doutor', $paciente->doutor) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Triagem</label>
                    <select name="cor" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">--</option>
                        <option value="vermelho" {{ $paciente->cor == 'vermelho' ? 'selected' : '' }}>Emergente</option>
                        <option value="laranja" {{ $paciente->cor == 'laranja' ? 'selected' : '' }}>Muito Urgente</option>
                        <option value="amarelo" {{ $paciente->cor == 'amarelo' ? 'selected' : '' }}>Urgente</option>
                        <option value="verde" {{ $paciente->cor == 'verde' ? 'selected' : '' }}>Pouco Urgente</option>
                        <option value="azul" {{ $paciente->cor == 'azul' ? 'selected' : '' }}>Não Urgente</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Atualizar</button>
            </form>
        </div>
    </div>
</x-app-layout>
