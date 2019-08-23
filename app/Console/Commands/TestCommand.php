<?php

namespace App\Console\Commands;

use App\Jobs\TestJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testcommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testando execucao de job com redis controlando as filas';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $queue = 'fila_teste';
        $job = (new TestJob())->onQueue($queue);
        dispatch($job);
    }
}
