<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Consultorio;

class ConsultorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultorio::create([
            'numero' => '1',
            'doutor' => 'Dr. Silva',
        ]);

        Consultorio::create([
            'numero' => '2',
            'doutor' => 'Dra. Santos',
        ]);

        Consultorio::create([
            'numero' => '3',
            'doutor' => 'Dr. Oliveira',
        ]);
    }
}
