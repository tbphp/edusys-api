<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'username' => 'required|email|unique:teachers',
            'password' => 'required|string|min:6|max:32',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
