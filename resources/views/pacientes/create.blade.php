<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Novo Paciente') }}
        </h2>
    </x-slot>

    <div class="py-6 flex items-center justify-center bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-2xl">
            <form action="{{ route('pacientes.store') }}" method="POST">
                @csrf

                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Preencha os Dados do Paciente</h3>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                    <input type="text" name="nome" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">CPF</label>
                    <input type="text" name="cpf" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SUS</label>
                    <input type="text" name="sus" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Endereço</label>
                    <input type="text" name="endereco" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Telefone</label>
                    <input type="text" name="telefone" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cadastrar
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
