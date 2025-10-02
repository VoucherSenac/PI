<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Consulta
        </h2>
    </x-slot>

    <div class="py-6 flex items-center justify-center bg-gray-100">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-full max-w-2xl">
            <form action="{{ route('consultas.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label for="paciente_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Paciente</label>
                    <select name="paciente_id" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="medico_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Médico</label>
                    <select name="medico_id" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label for="data_hora" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Data e Hora</label>
                    <input type="datetime-local" name="data_hora" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label for="observacoes" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Observações</label>
                    <textarea name="observacoes" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="border border-gray-300 dark:border-gray-700 p-3 w-full rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="agendada">Agendada</option>
                        <option value="concluida">Concluída</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Salvar Consulta
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
