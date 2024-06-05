<?php

namespace App\Http\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CurrencyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code_alfa' => ['required', 'string', 'size:3'],
            'code_num' => ['required', 'string', 'size:3'],
        ];
    }
}
