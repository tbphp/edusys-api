<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolStudentUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:50',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
