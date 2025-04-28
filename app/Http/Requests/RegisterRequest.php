<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Username' => 'required|string|max:255',
            'Password' => 'required|string|min:6|confirmed',
        ];
    }
}
