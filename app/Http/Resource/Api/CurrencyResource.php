<?php

namespace App\Http\Resource\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code_alfa' => $this->code_alfa,
            'code_num' => $this->code_num,
            'rate_buy' => $this->rate_buy,
            'rate_sell' => $this->rate_sell,
            'rate_cross' => $this->rate_cross,
        ];
    }
}
