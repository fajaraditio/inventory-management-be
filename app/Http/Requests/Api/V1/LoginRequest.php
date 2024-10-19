<?php

namespace App\Http\Requests\Api\V1;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $user = User::where('email', $validator->safe()->email)->first();

                if (!password_verify($validator->safe()->password, $user->password))
                    $validator->errors()->add('password', 'You might be entered wrong password');
            }
        ];
    }
}
