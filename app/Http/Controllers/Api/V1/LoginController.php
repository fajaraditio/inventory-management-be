<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validatedRequest = $request->safe()->all();

        $user = User::where('email', $validatedRequest['email'])->first();

        $token = $user->createToken('pat')->plainTextToken;

        return response()->json([
            'message' => 'User authenticated',
            'data' => [
                'token' => $token,
            ],
        ]);
    }
}
