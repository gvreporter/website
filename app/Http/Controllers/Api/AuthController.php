<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);
        if(!$token = auth('api')->attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token, auth('api')->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  \App\Models\User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, User $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user->toArray()
        ]);
    }

    public function me()
    {
        $user = auth('api')->user();
        return response()->json($user->toArray());
    }
}
