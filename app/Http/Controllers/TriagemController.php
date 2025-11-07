<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use App\Models\Consultorio;
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
        $consultorios = Consultorio::all();
        return view('triagens.create', compact('paciente', 'consultorios'));
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
            'pressao_sistolica' => 'required|integer|min:0|max:300',
            'pressao_diastolica' => 'required|integer|min:0|max:200',
            'frequencia_cardiaca' => 'required|integer|min:0|max:300',
            'temperatura' => 'required|numeric|min:0|max:99.9',
            'peso' => 'required|numeric|min:0|max:999.99',
            'altura' => 'required|numeric|min:0|max:9.99',
            'frequencia_respiratoria' => 'nullable|integer|min:0|max:100',
            'gravidade' => 'required|in:vermelho,laranja,amarelo,verde,azul',
            'consultorio_id' => 'nullable|exists:consultorios,id',
        ], [
            'queixa_principal.required' => 'A queixa principal é obrigatória.',
            'queixa_principal.string' => 'A queixa principal deve ser um texto.',
            'queixa_principal.max' => 'A queixa principal deve ter no máximo 255 caracteres.',
            'historico_doencas.string' => 'O histórico de doenças deve ser um texto.',
            'alergias.string' => 'As alergias devem ser um texto.',
            'fuma.boolean' => 'O campo fuma deve ser verdadeiro ou falso.',
            'bebe.boolean' => 'O campo bebe deve ser verdadeiro ou falso.',
            'medicamentos_uso.string' => 'Os medicamentos em uso devem ser um texto.',
            'pressao_sistolica.required' => 'A pressão sistólica é obrigatória.',
            'pressao_sistolica.integer' => 'A pressão sistólica deve ser um número inteiro.',
            'pressao_sistolica.min' => 'A pressão sistólica deve ser no mínimo 0.',
            'pressao_sistolica.max' => 'A pressão sistólica deve ser no máximo 300.',
            'pressao_diastolica.required' => 'A pressão diastólica é obrigatória.',
            'pressao_diastolica.integer' => 'A pressão diastólica deve ser um número inteiro.',
            'pressao_diastolica.min' => 'A pressão diastólica deve ser no mínimo 0.',
            'pressao_diastolica.max' => 'A pressão diastólica deve ser no máximo 200.',
            'frequencia_cardiaca.required' => 'A frequência cardíaca é obrigatória.',
            'frequencia_cardiaca.integer' => 'A frequência cardíaca deve ser um número inteiro.',
            'frequencia_cardiaca.min' => 'A frequência cardíaca deve ser no mínimo 0.',
            'frequencia_cardiaca.max' => 'A frequência cardíaca deve ser no máximo 300.',
            'temperatura.required' => 'A temperatura é obrigatória.',
            'temperatura.numeric' => 'A temperatura deve ser um número.',
            'temperatura.min' => 'A temperatura deve ser no mínimo 0.',
            'temperatura.max' => 'A temperatura deve ser no máximo 99.9.',
            'peso.required' => 'O peso é obrigatório.',
            'peso.numeric' => 'O peso deve ser um número.',
            'peso.min' => 'O peso deve ser no mínimo 0.',
            'peso.max' => 'O peso deve ser no máximo 999.99.',
            'altura.required' => 'A altura é obrigatória.',
            'altura.numeric' => 'A altura deve ser um número.',
            'altura.min' => 'A altura deve ser no mínimo 0.',
            'altura.max' => 'A altura deve ser no máximo 9.99.',
            'frequencia_respiratoria.integer' => 'A frequência respiratória deve ser um número inteiro.',
            'frequencia_respiratoria.min' => 'A frequência respiratória deve ser no mínimo 0.',
            'frequencia_respiratoria.max' => 'A frequência respiratória deve ser no máximo 100.',
            'gravidade.required' => 'A gravidade é obrigatória.',
            'gravidade.in' => 'A gravidade selecionada é inválida.',
            'consultorio_id.exists' => 'O consultório selecionado é inválido.',
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
    public function show(Paciente $paciente)
    {
        $triagem = $paciente->triagens()->latest()->first();

        if (!$triagem) {
            return redirect()->route('pacientes.index')->with('error', 'Este paciente ainda não possui triagem.');
        }

        return view('triagens.show', compact('paciente', 'triagem'));
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
    public function update(Request $request, Paciente $paciente, Triagem $triagem)
    {
        $validator = Validator::make($request->all(), [
            'gravidade' => 'required|in:vermelho,laranja,amarelo,verde,azul',
        ], [
            'gravidade.required' => 'A gravidade é obrigatória.',
            'gravidade.in' => 'A gravidade selecionada é inválida.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        $triagem->update($data);

        // Atualizar cor do paciente baseada na gravidade da triagem
        $paciente->update(['cor' => $triagem->gravidade]);

        return redirect()->back()->with('success', 'Gravidade atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
