<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TriagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paciente $paciente)
    {
        return view('triagens.create', compact('paciente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Paciente $paciente)
    {
        // Preparar dados antes da validação
        $inputData = $request->all();
        $inputData['fuma'] = $request->has('fuma') ? true : false;
        $inputData['bebe'] = $request->has('bebe') ? true : false;

        $validator = Validator::make($inputData, [
            'queixa_principal' => 'required|string|max:255',
            'historico_doencas' => 'nullable|string',
            'alergias' => 'nullable|string',
            'fuma' => 'boolean',
            'bebe' => 'boolean',
            'medicamentos_uso' => 'nullable|string',
            'gravidade' => 'required|in:vermelho,laranja,amarelo,verde,azul',
        ], [
            'queixa_principal.required' => 'A queixa principal é obrigatória.',
            'queixa_principal.string' => 'A queixa principal deve ser um texto.',
            'queixa_principal.max' => 'A queixa principal deve ter no máximo 255 caracteres.',
            'historico_doencas.string' => 'O histórico de doenças deve ser um texto.',
            'alergias.string' => 'As alergias devem ser um texto.',
            'fuma.boolean' => 'O campo fuma deve ser verdadeiro ou falso.',
            'bebe.boolean' => 'O campo bebe deve ser verdadeiro ou falso.',
            'medicamentos_uso.string' => 'Os medicamentos em uso devem ser um texto.',
            'gravidade.required' => 'A gravidade é obrigatória.',
            'gravidade.in' => 'A gravidade selecionada é inválida.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        $triagem = Triagem::create([
            'paciente_id' => $paciente->id,
            ...$data
        ]);

        // Atualizar cor do paciente baseada na gravidade da triagem
        $paciente->update(['cor' => $triagem->gravidade]);

        // Adicionar à fila se não estiver
        if (!$paciente->em_fila) {
            $paciente->update(['em_fila' => true]);
        }

        return redirect()->route('pacientes.index')->with('success', 'Triagem realizada com sucesso! Paciente adicionado à fila.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
