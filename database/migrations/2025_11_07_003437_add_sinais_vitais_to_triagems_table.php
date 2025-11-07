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
        Schema::table('triagems', function (Blueprint $table) {
            $table->integer('pressao_sistolica')->nullable();
            $table->integer('pressao_diastolica')->nullable();
            $table->integer('frequencia_cardiaca')->nullable();
            $table->decimal('temperatura', 4, 1)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->decimal('altura', 3, 2)->nullable();
            $table->integer('frequencia_respiratoria')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('triagems', function (Blueprint $table) {
            $table->dropColumn([
                'pressao_sistolica',
                'pressao_diastolica',
                'frequencia_cardiaca',
                'temperatura',
                'peso',
                'altura',
                'frequencia_respiratoria'
            ]);
        });
    }
};
