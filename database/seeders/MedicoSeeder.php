<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;

class MedicoSeeder extends Seeder
{
    public function run(): void
    {
        Medico::create([
            'nome' => 'Dr. João Silva',
            'especialidade' => 'Cardiologia'
        ]);

        Medico::create([
            'nome' => 'Dra. Maria Oliveira',
            'especialidade' => 'Pediatria'
        ]);

        Medico::create([
            'nome' => 'Dr. Pedro Santos',
            'especialidade' => 'Ortopedia'
        ]);
    }
}
