<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        Paciente::create([
            'nome' => 'Carlos Souza',
            'cpf' => '12345678901',
            'data_nascimento' => '1990-05-10'
        ]);

        Paciente::create([
            'nome' => 'Ana Lima',
            'cpf' => '98765432100',
            'data_nascimento' => '1985-11-20'
        ]);

        Paciente::create([
            'nome' => 'Fernanda Rocha',
            'cpf' => '45678912399',
            'data_nascimento' => '2000-03-15'
        ]);
    }
}
