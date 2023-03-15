<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LineLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|string|min:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
