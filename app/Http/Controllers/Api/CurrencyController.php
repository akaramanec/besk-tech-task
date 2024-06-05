<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Request\CurrencyRequest;
use App\Http\Resource\Api\CurrencyResource;
use App\Models\Project\Currency;

class CurrencyController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Currency::class, 'currency');
    }

    public function index()
    {
        $this->authorize('viewAny', Currency::class);
        return CurrencyResource::collection(Currency::all());
    }

    public function store(CurrencyRequest $request)
    {
        $currency = Currency::firstOrCreate($request->validated());
        return new CurrencyResource($currency);
    }

    public function show(Currency $currency)
    {
        return new CurrencyResource($currency);
    }

    public function update(CurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->validated());
        $currency->refresh();

        return new CurrencyResource($currency);
    }

    public function destroy(Currency $currency)
    {
        $currency->delete();

        return response()->json(['message' => 'Currency rate deleted']);
    }
}
