<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolStudentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:4|max:50|unique:students',
            'name' => 'required|string|min:2|max:50',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
