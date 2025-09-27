<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('medico_id');
            $table->dateTime('data_hora');
            $table->text('observacoes')->nullable();
            $table->enum('status', ['agendada', 'concluida', 'cancelada'])->default('agendada');
            $table->timestamps();
    
            // Relações (FKs)
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('medico_id')->references('id')->on('medicos');
        });
    }
    
};
