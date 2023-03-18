<?php

namespace App\Http\Requests;

use App\Enums\IdentityEnum;
use Illuminate\Foundation\Http\FormRequest;

class LineBindRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'hash' => 'required_without:code|string|nullable',
            'code' => 'required_without:hash|string|min:6|nullable',
            'identity' => 'required|integer|enum_value:' . IdentityEnum::class,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
