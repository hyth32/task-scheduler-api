<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Services\Auth\RefreshTokenService;
use Illuminate\Http\JsonResponse;

class RefreshTokenController extends Controller
{
    public function __invoke(RefreshTokenRequest $request, RefreshTokenService $service): JsonResponse
    {
        $tokens = $service->handle($request->refresh_token);

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $tokens['access'],
            'expires_in' => $tokens['expires_in'],
        ]);
    }
}
