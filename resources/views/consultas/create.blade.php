<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nova Consulta
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <form action="{{ route('consultas.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="paciente_id" class="block mb-1">Paciente</label>
                    <select name="paciente_id" class="border rounded w-full p-2">
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="medico_id" class="block mb-1">Médico</label>
                    <select name="medico_id" class="border rounded w-full p-2">
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="data_hora" class="block mb-1">Data e Hora</label>
                    <input type="datetime-local" name="data_hora" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label for="observacoes" class="block mb-1">Observações</label>
                    <textarea name="observacoes" class="border rounded w-full p-2"></textarea>
                </div>

                <div class="mb-4">
                    <label for="status" class="block mb-1">Status</label>
                    <select name="status" class="border rounded w-full p-2">
                        <option value="agendada">Agendada</option>
                        <option value="concluida">Concluída</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Salvar Consulta
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
