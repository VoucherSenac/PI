@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Consulta</h1>

    <form action="{{ route('consultas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="paciente_id">Paciente</label>
            <select name="paciente_id" class="form-control">
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id }}">{{ $paciente->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="medico_id">Médico</label>
            <select name="medico_id" class="form-control">
                @foreach($medicos as $medico)
                    <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="data_hora">Data e Hora</label>
            <input type="datetime-local" name="data_hora" class="form-control">
        </div>

        <div class="mb-3">
            <label for="observacoes">Observações</label>
            <textarea name="observacoes" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="agendada">Agendada</option>
                <option value="concluida">Concluída</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Consulta</button>
    </form>
</div>
@endsection
