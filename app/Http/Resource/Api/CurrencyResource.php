<?php

namespace App\Http\Resource\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    public function toArray($request)
    {
        $buy = null;
        $sell = null;
        $cross = null;
        if ($this->rate_buy && $this->rate_sell) {
            $buy = $this->rate_buy;
            $sell = $this->rate_sell;
        }
        if ($this->rate_cross) {
            $cross = $this->rate_cross;
        }
        $data = [
            'id' => $this->id,
            'code_alfa' => $this->code_alfa,
            'code_num' => $this->code_num,
        ];
        if ($buy && $sell) {
            $data['buy'] = $buy;
            $data['sell'] = $sell;
        }
        if ($cross) {
            $data['cross_coefficient'] = $cross;
        }
        return $data;
    }
}
