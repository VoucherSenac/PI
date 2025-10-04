<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pacientes')->where('cor', 'vermelho')->update(['cor' => 'emergente']);
        DB::table('pacientes')->where('cor', 'laranja')->update(['cor' => 'muito urgente']);
        DB::table('pacientes')->where('cor', 'amarelo')->update(['cor' => 'urgente']);
        DB::table('pacientes')->where('cor', 'verde')->update(['cor' => 'pouco urgente']);
        DB::table('pacientes')->where('cor', 'azul')->update(['cor' => 'não urgente']);
    }

    public function down(): void
    {
        DB::table('pacientes')->where('cor', 'emergente')->update(['cor' => 'vermelho']);
        DB::table('pacientes')->where('cor', 'muito urgente')->update(['cor' => 'laranja']);
        DB::table('pacientes')->where('cor', 'urgente')->update(['cor' => 'amarelo']);
        DB::table('pacientes')->where('cor', 'pouco urgente')->update(['cor' => 'verde']);
        DB::table('pacientes')->where('cor', 'não urgente')->update(['cor' => 'azul']);
    }
};
