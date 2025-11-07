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

    public function index()
    {
        // Carregar consultas junto com paciente e médico
        $consultas = Consulta::with(['paciente', 'medico'])->get();

        return view('consultas.index', compact('consultas'));
    }

    public function atendimento(Paciente $paciente)
    {
        $triagem = $paciente->triagens()->latest()->first();

        if (!$triagem) {
            return redirect()->route('pacientes.index')->with('error', 'Este paciente ainda não possui triagem.');
        }

        return view('consultas.atendimento', compact('paciente', 'triagem'));
    }

    public function storeAtendimento(Request $request, Paciente $paciente)
    {
        $request->validate([
            'hipoteses_diagnosticas' => 'nullable|string',
            'condicao_fisica' => 'nullable|string',
            'exames_necessarios' => 'nullable|string',
            'medicamentos_receitados' => 'nullable|string',
            'observacoes_atendimento' => 'nullable|string',
        ]);

        $consulta = Consulta::create([
            'paciente_id' => $paciente->id,
            'medico_id' => auth()->id(), // Assumindo que o médico logado é o usuário atual
            'data_hora' => now(),
            'status' => 'concluida',
            ...$request->only([
                'hipoteses_diagnosticas',
                'condicao_fisica',
                'exames_necessarios',
                'medicamentos_receitados',
                'observacoes_atendimento'
            ])
        ]);

        // Remover paciente da fila após atendimento
        $paciente->update(['em_fila' => false]);

        return redirect()->route('pacientes.index')->with('success', 'Atendimento realizado com sucesso!');
    }
}

