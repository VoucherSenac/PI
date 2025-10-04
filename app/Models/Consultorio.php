<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    protected $fillable = ['nome'];

    public function pacientes()
    {
        return $this->hasMany(Paciente::class);
    }
}
