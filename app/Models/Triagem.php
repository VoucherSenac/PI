<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'queixa_principal',
        'historico_doencas',
        'alergias',
        'fuma',
        'bebe',
        'medicamentos_uso',
        'pressao_sistolica',
        'pressao_diastolica',
        'frequencia_cardiaca',
        'temperatura',
        'peso',
        'altura',
        'frequencia_respiratoria',
        'gravidade',
        'consultorio_id',
    ];

    protected $casts = [
        'fuma' => 'boolean',
        'bebe' => 'boolean',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }
}
