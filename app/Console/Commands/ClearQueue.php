<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Paciente;

class ClearQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa a fila de pacientes diariamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Paciente::where('em_fila', true)->update(['em_fila' => false]);

        $this->info('Fila de pacientes limpa com sucesso!');
    }
}
