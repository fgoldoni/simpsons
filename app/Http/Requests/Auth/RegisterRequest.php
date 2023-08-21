<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', Password::defaults()],
        ];
    }

    public function token(AuthManager $authManager, $user): string
    {
        return $authManager->guard('api')->login($user);
    }
}
