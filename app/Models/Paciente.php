<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para Mass Assignment
     */
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'sus',
        'telefone',
        'endereco',
        'cor',
        'marcado',
        'em_fila',
        'consultorio_id',
    ];

    /**
     * Casts de atributos
     */
    protected $casts = [
        'marcado' => 'boolean',
        'em_fila' => 'boolean',
    ];

    /**
     * Relacionamentos
     */
    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * Scopes úteis para filtros
     */
    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        $term = trim($term);
        return $query->where(function ($q) use ($term) {
            $q->where('nome', 'like', "%{$term}%")
              ->orWhere('cpf', 'like', "%{$term}%")
              ->orWhere('sus', 'like', "%{$term}%");
        });
    }

    public function scopeMarcados($query)
    {
        return $query->where('marcado', true);
    }

    public function scopeNaFila($query)
    {
        return $query->where('em_fila', true);
    }
}
