<?php

namespace App\Http\Requests;

use App\Enums\IdentityEnum;
use Illuminate\Foundation\Http\FormRequest;

class LineBindRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'hash' => 'required|string',
            'identity' => 'required|integer|enum_value:' . IdentityEnum::class,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
