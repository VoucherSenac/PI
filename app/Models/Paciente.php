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
    ];

    /**
     * Casts de atributos
     */
    protected $casts = [
        'marcado' => 'boolean',
        'em_fila' => 'boolean',
    ];

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

    public function triagens()
    {
        return $this->hasMany(Triagem::class);
    }

    public function ultimaTriagem()
    {
        return $this->hasOne(Triagem::class)->latest();
    }
}
