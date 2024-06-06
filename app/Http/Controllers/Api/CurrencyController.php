<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\CurrencyRequest;
use App\Http\Resource\Api\CurrencyResource;
use App\Jobs\ParseMonobankRatesJob;
use App\Models\Project\Currency;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class CurrencyController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Currency::class);
        $currencies = Currency::all()->each(function ($currency) {
            Cache::set('currency:' . $currency->id, $currency);
        });
        return CurrencyResource::collection($currencies);
    }

    public function store(CurrencyRequest $request)
    {
        $this->authorize('create', Currency::class);
        $currency = Currency::firstOrCreate($request->validated());
        if ($currency->wasRecentlyCreated) {
            ParseMonobankRatesJob::dispatch();
        }
        return new CurrencyResource($currency);
    }

    public function show($id)
    {
        $currency = Cache::get('currency:' . $id);
        $this->authorize('view', $currency);
        if (!$currency) {
            return response()->json(['status' => 'error', 'message' => 'Currency not found'], Response::HTTP_NOT_FOUND);
        }
        return new CurrencyResource($currency);
    }

    public function update(CurrencyRequest $request, Currency $currency)
    {
        $this->authorize('update', $currency);
        $currency->update($request->validated());
        $currency->refresh();
        Cache::set('currency:' . $currency->id, $currency);
        return new CurrencyResource($currency);
    }

    public function destroy(Currency $currency)
    {
        $this->authorize('delete', $currency);
        $currency->delete();
        return response()->json(['message' => 'Currency rate deleted']);
    }
}
