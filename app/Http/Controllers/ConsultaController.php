<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos   = Medico::all();

        return view('consultas.create', compact('pacientes', 'medicos'));
    }
    public function store(Request $request)
    {
        // Validação dos dados enviados no formulário
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id'   => 'required|exists:medicos,id',
            'data_hora'   => 'required|date',
            'observacoes' => 'nullable|string',
            'status'      => 'required|in:agendada,concluida,cancelada',
        ]);

        // Criar consulta
        Consulta::create($request->all());

        // Redirecionar para a lista com mensagem de sucesso
        return redirect()->route('consultas.index')
                         ->with('success', 'Consulta criada com sucesso!');
    }

    public function index(Request $request)
    {
        $query = Consulta::with(['paciente', 'medico']);

        if ($search = $request->get('search')) {
            $query->whereHas('paciente', function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%");
            })->orWhereHas('medico', function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%");
            })->orWhere('status', 'like', "%{$search}%");
        }

        $consultas = $query->get();

        return view('consultas.index', compact('consultas'));
    }
}

