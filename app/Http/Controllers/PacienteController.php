<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Listagem de pacientes com busca
     */
    public function index(Request $request)
    {
        $pacientes = Paciente::search($request->get('search'))
                             ->paginate(10);

        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Formulário de criação
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Salvar novo paciente
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cpf'      => 'required|string|max:14|unique:pacientes,cpf',
            'sus'      => 'required|string|max:20|unique:pacientes,sus',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'cor'      => 'nullable|string',
        ]);

        Paciente::create($data);

        return redirect()->route('pacientes.index')
                         ->with('msg', 'Paciente cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Atualizar paciente
     */
    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'nome'     => 'required|string|max:255',
            'cpf'      => 'required|string|max:14|unique:pacientes,cpf,' . $paciente->id,
            'sus'      => 'required|string|max:20|unique:pacientes,sus,' . $paciente->id,
            'telefone' => 'required|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cor'      => 'nullable|string',
        ]);

        $paciente->update($data);

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente atualizado com sucesso!');
    }

    /**
     * Mostrar detalhes de um paciente
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Exibir pacientes na fila
     */
    public function fila()
    {
        $pacientes = Paciente::naFila()->get();
        return view('pacientes.fila', compact('pacientes'));
    }

    /**
     * Adicionar paciente à fila
     */
    public function adicionarFila(Paciente $paciente)
    {
        $paciente->em_fila = true;
        $paciente->save();

        return redirect()->back()->with('success', 'Paciente adicionado à fila!');
    }

    /**
     * Remover paciente da fila
     */
    public function removerFila(Paciente $paciente)
    {
        $paciente->em_fila = false;
        $paciente->save();

        return redirect()->back()->with('success', 'Paciente removido da fila!');
    }
}
