<?php

namespace App\Jobs;

use App\Models\Project\Currency;
use App\Services\Currency\MonobankService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ParseMonobankRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('ParseMonobankRatesJob started');
        $service = new MonobankService();
        $service->parsMainCurrenciesRate();
        $this->cacheCurrencies();
    }

    private function cacheCurrencies()
    {
        Cache::flush();
        Currency::all()->each(function ($currency) {
            Cache::set('currency:' . $currency->id, $currency);
        });
    }
}
