<?php

namespace App\Services\Currency;

use App\Models\Project\Currency;
use Carbon\Carbon;

class MonobankService
{
    const CURRENCY_URI = '/bank/currency';
    const CODE_NUM_UAH = 980;

    const URL = 'https://api.monobank.ua';
    public function __construct()
    {
        $this->url = config('app.mono_url');
    }

    public function getAllCurrenciesRate()
    {
        return $this->curl(self::URL . self::CURRENCY_URI . '?json');
    }

    public function parsMainCurrenciesRate(): void
    {
        $allCurrencies =  $this->getAllCurrenciesRate();
        foreach ($allCurrencies as $currencyRate) {
            if ($currencyRate['currencyCodeB'] == self::CODE_NUM_UAH && ($currency = Currency::where('code_num', $currencyRate['currencyCodeA'])->first())) {
                $currency->update([
                    'rate_buy' => isset($currencyRate['rateBuy']) ? round($currencyRate['rateBuy'], 2) : null,
                    'rate_sell' => isset($currencyRate['rateSell']) ? round($currencyRate['rateSell'], 2) : null,
                    'rate_cross' => isset($currencyRate['rateCross']) ? round($currencyRate['rateCross'], 5) : null,
                    'date' => Carbon::parse($currencyRate['date']),
                ]);
                dump($currency->toArray());
            }
        }
    }

    public function curl($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers());

        curl_setopt($curl, CURLOPT_HTTPGET, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $output = curl_exec($curl);

        curl_close($curl);
        if (is_string($output) && is_array($a = json_decode($output, true))) {
            return $a;
        } else {
            return $output;
        }
    }

    public function headers()
    {
        return [
            'Accept: application/json',
            'Cache-Control: no-cache',
            'Content-Type: application/json',
        ];
    }
}
