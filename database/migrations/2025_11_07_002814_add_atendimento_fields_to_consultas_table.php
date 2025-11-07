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
        Schema::table('consultas', function (Blueprint $table) {
            $table->text('hipoteses_diagnosticas')->nullable();
            $table->text('condicao_fisica')->nullable();
            $table->text('exames_necessarios')->nullable();
            $table->text('medicamentos_receitados')->nullable();
            $table->text('observacoes_atendimento')->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 3, 2)->nullable();
            $table->decimal('temperatura', 4, 1)->nullable();
            $table->integer('pressao_sistolica')->nullable();
            $table->integer('pressao_diastolica')->nullable();
            $table->integer('frequencia_cardiaca')->nullable();
            $table->integer('frequencia_respiratoria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropColumn([
                'hipoteses_diagnosticas',
                'condicao_fisica',
                'exames_necessarios',
                'medicamentos_receitados',
                'observacoes_atendimento',
                'peso',
                'altura',
                'temperatura',
                'pressao_sistolica',
                'pressao_diastolica',
                'frequencia_cardiaca',
                'frequencia_respiratoria'
            ]);
        });
    }
};
