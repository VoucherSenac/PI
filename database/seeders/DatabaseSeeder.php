<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void


    {
        $this->call([
            MedicoSeeder::class,
            PacienteSeeder::class,
            ConsultorioSeeder::class,
        ]);
    }
}

