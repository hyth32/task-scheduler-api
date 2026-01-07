<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request, LoginService $service): JsonResponse
    {
        $tokens = $service->handle($request->validated());

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $tokens['access'],
            'refresh_token' => $tokens['refresh'],
            'expires_in' => $tokens['expires_in'],
        ]);
    }
}
