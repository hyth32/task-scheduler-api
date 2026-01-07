<?php

namespace App\Services\Auth;

use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class RefreshTokenService
{
    public function __construct(private TokenService $tokenService) {}

    public function handle(string $refreshToken): array
    {
        $token = PersonalAccessToken::findToken($refreshToken);

        if (!$token || $token->name !== 'refresh_token') {
            throw ValidationException::withMessages([
                'refresh_token' => ['Invalid refresh token'],
            ]);
        }

        if ($token->expires_at && $token->expires_at->isPast()) {
            $token->delete();

            throw ValidationException::withMessages([
                'refresh_token' => ['Refresh token has expired'],
            ]);
        }

        $user = $token->tokenable;

        return [
            'access' => $this->tokenService->createAccessToken($user),
            'expires_in' => TokenService::ACCESS_TOKEN_EXPIRATION_MIN * 60,
        ];
    }
}
