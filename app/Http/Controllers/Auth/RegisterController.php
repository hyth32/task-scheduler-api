<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterService $service): JsonResponse
    {
        $data = $service->handle($request->validated());
        
        return response()->json([
            'user' => $data['user'],
            'token_type' => 'Bearer',
            'access_token' => $data['access'],
            'refresh_token' => $data['refresh'],
            'expires_in' => $data['expires_in'],
        ], 201);
    }
}
