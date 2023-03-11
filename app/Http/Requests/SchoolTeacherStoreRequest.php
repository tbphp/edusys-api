<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolTeacherStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|email',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
