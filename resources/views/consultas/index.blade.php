@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Consultas Cadastradas</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Data/Hora</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->id }}</td>
                    <td>{{ $consulta->paciente->nome }}</td>
                    <td>{{ $consulta->medico->nome }}</td>
                    <td>{{ $consulta->data_hora }}</td>
                    <td>{{ ucfirst($consulta->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
