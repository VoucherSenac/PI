<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Listagem de pacientes com busca e paginação
     */
    public function index(Request $request)
    {
        $query = Paciente::query();

        if ($search = $request->get('search')) {
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%")
                  ->orWhere('sus', 'like', "%{$search}%");
        }

        $pacientes = $query->paginate(10);

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
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cor'      => 'nullable|string|in:emergente,muito urgente,urgente,pouco urgente,não urgente',
            'consultorio_id' => 'nullable|exists:consultorios,id',
        ]);

        Paciente::create($data);

        return redirect()->route('pacientes.index')->with('success', 'Paciente cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Atualizar paciente (full ou parcial para cor)
     */
    public function update(Request $request, Paciente $paciente)
    {
        if ($request->has('cor') && !$request->has('nome')) {
            // Atualização parcial (cor)
            $request->validate([
                'cor' => 'nullable|string|in:emergente,muito urgente,urgente,pouco urgente,não urgente',
            ]);
            $paciente->update($request->only(['cor']));
        } else {
            // Atualização completa
            $data = $request->validate([
                'nome'     => 'required|string|max:255',
                'cpf'      => 'required|string|max:14|unique:pacientes,cpf,' . $paciente->id,
                'sus'      => 'required|string|max:20|unique:pacientes,sus,' . $paciente->id,
                'telefone' => 'nullable|string|max:20',
                'endereco' => 'nullable|string|max:255',
                'cor'      => 'nullable|string|in:emergente,muito urgente,urgente,pouco urgente,não urgente',
                'consultorio_id' => 'nullable|exists:consultorios,id',
            ]);
            $paciente->update($data);
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente atualizado com sucesso!');
    }

    /**
     * Deletar paciente
     */
    public function destroy(Paciente $paciente)
    {
        // Deletar consultas associadas
        $paciente->consultas()->delete();

        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente deletado com sucesso!');
    }


    /**
     * Mostrar pacientes na fila, ordenados por prioridade
     */
    public function fila()
    {
        $pacientes = Paciente::where('em_fila', true)
            ->orderByRaw("FIELD(cor,'emergente','muito urgente','urgente','pouco urgente','não urgente','') DESC")
            ->paginate(10);

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

    /**
     * Detalhes de paciente (opcional)
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }
}
