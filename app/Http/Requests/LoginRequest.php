<?php

namespace App\Http\Requests;

use App\Enums\IdentityEnum;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'identity' => 'required|integer|enum_value:' . IdentityEnum::class,
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        // 教师用户名需要验证邮箱格式
        $isTeacher = $this->input('identity') == IdentityEnum::TEACHER;
        if ($isTeacher) {
            $rules['username'] .= '|email';
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
