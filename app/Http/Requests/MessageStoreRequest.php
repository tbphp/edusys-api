<?php

namespace App\Http\Requests;

use App\Enums\IdentityEnum;
use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identity' => 'required|integer|enum_value:' . IdentityEnum::class,
            'user_id' => 'required|int',
            'message' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
