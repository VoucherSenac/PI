<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'data_hora',
        'observacoes',
        'status',
        'hipoteses_diagnosticas',
        'condicao_fisica',
        'exames_necessarios',
        'medicamentos_receitados',
        'observacoes_atendimento',
        'peso',
        'altura',
        'temperatura',
        'pressao_sistolica',
        'pressao_diastolica',
        'frequencia_cardiaca',
        'frequencia_respiratoria'
    ];

    // Relacionamentos
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}

