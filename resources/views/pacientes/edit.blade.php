<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('pacientes.index') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Paciente') }}
            </h2>
        </div>
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
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">SUS</label>
                    <input type="text" name="sus" value="{{ old('sus', $paciente->sus) }}" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
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
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Triagem</label>
                    <select name="cor" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">--</option>
                        <option value="emergente" {{ $paciente->cor == 'emergente' ? 'selected' : '' }}>Emergente</option>
                        <option value="muito urgente" {{ $paciente->cor == 'muito urgente' ? 'selected' : '' }}>Muito Urgente</option>
                        <option value="urgente" {{ $paciente->cor == 'urgente' ? 'selected' : '' }}>Urgente</option>
                        <option value="pouco urgente" {{ $paciente->cor == 'pouco urgente' ? 'selected' : '' }}>Pouco Urgente</option>
                        <option value="não urgente" {{ $paciente->cor == 'não urgente' ? 'selected' : '' }}>Não Urgente</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Consultório</label>
                    <select name="consultorio_id" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="">--</option>
                        @foreach(\App\Models\Consultorio::all() as $consultorio)
                            <option value="{{ $consultorio->id }}" {{ $paciente->consultorio_id == $consultorio->id ? 'selected' : '' }}>
                                {{ $consultorio->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">Atualizar</button>
                    <button type="button" onclick="if(confirm('Tem certeza que deseja excluir este paciente?')) { this.form.action='{{ route('pacientes.destroy', $paciente) }}'; this.form.querySelector('input[name=_method]').value='DELETE'; this.form.submit(); }" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                        Excluir Paciente
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
