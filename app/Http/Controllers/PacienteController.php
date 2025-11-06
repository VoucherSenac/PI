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
            'data_nascimento' => 'nullable|date',
            'sus'      => 'required|string|max:20|unique:pacientes,sus',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
            'cor'      => 'nullable|string|in:vermelho,laranja,amarelo,verde,azul,',
            'consultorio' => 'nullable|string|max:255',
            'doutor' => 'nullable|string|max:255',
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
                'cor' => 'nullable|string|in:vermelho,laranja,amarelo,verde,azul,',
            ]);
            $paciente->update($request->only(['cor']));
        } else {
            // Atualização completa
            $data = $request->validate([
                'nome'     => 'required|string|max:255',
                'cpf'      => 'required|string|max:14|unique:pacientes,cpf,' . $paciente->id,
                'data_nascimento' => 'nullable|date',
                'sus'      => 'required|string|max:20|unique:pacientes,sus,' . $paciente->id,
                'telefone' => 'nullable|string|max:20',
                'endereco' => 'nullable|string|max:255',
                'cor'      => 'nullable|string|in:vermelho,laranja,amarelo,verde,azul,',
                'consultorio' => 'nullable|string|max:255',
                'doutor' => 'nullable|string|max:255',
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
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente deletado com sucesso!');
    }

    /**
     * Mostrar pacientes na fila, ordenados por prioridade
     */
    public function fila()
    {
        $pacientes = Paciente::where('em_fila', true)
            ->get()
            ->sortBy(function ($paciente) {
                $prioridades = [
                    'vermelho' => 5,
                    'laranja' => 4,
                    'amarelo' => 3,
                    'verde' => 2,
                    'azul' => 1,
                    '' => 0,
                ];
                return $prioridades[$paciente->cor] ?? 0;
            })
            ->reverse()
            ->values();

        $pacientes = new \Illuminate\Pagination\LengthAwarePaginator(
            $pacientes->forPage(request('page', 1), 10),
            $pacientes->count(),
            10,
            request('page', 1),
            ['path' => request()->url(), 'pageName' => 'page']
        );

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
