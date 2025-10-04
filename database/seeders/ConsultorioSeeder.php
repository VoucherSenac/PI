<?php

namespace Database\Seeders;

use App\Models\Consultorio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Consultorio::create(['nome' => 'Consultório 1']);
        Consultorio::create(['nome' => 'Consultório 2']);
        Consultorio::create(['nome' => 'Consultório 3']);
        Consultorio::create(['nome' => 'Consultório 4']);
        Consultorio::create(['nome' => 'Consultório 5']);
        Consultorio::create(['nome' => 'Consultório 6']);
    }
}
