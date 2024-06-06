<?php

namespace App\Console\Commands;

use App\Jobs\ParseMonobankRatesJob;
use App\Services\Currency\MonobankService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ParseMonobankRatesJob::dispatch();
    }
}
