<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestJob extends Job implements ShouldQueue, SelfHandling
{
    public function handle()
    {
        Log::debug('TestJob');
    }
}
