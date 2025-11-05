<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('triagems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->string('queixa_principal');
            $table->text('historico_doencas')->nullable();
            $table->text('alergias')->nullable();
            $table->boolean('fuma')->default(false);
            $table->boolean('bebe')->default(false);
            $table->text('medicamentos_uso')->nullable();
            $table->enum('gravidade', ['vermelho', 'laranja', 'amarelo', 'verde', 'azul']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triagems');
    }
};
