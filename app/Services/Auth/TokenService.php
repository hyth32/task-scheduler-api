<?php

namespace App\Services\Auth;

use App\Models\User;

class TokenService
{
    const ACCESS_TOKEN_EXPIRATION_MIN = 15;
    const REFRESH_TOKEN_EXPIRATION_MIN = 43200;

    public function createTokens(User $user): array
    {
        $accessToken = $this->createAccessToken($user);
        $refreshToken = $this->createRefreshToken($user);

        return [
            'access' => $accessToken,
            'refresh' => $refreshToken,
            'expires_in' => self::ACCESS_TOKEN_EXPIRATION_MIN * 60,
        ];
    }

    public function createAccessToken(User $user): string
    {
        return $user->createToken(
            'access_token',
            ['*'],
            now()->addMinutes(self::ACCESS_TOKEN_EXPIRATION_MIN),
        )->plainTextToken;
    }

    public function createRefreshToken(User $user): string
    {
        return $user->createToken(
            'refresh_token',
            ['*'],
            now()->addMinutes(self::REFRESH_TOKEN_EXPIRATION_MIN),
        )->plainTextToken;
    }
}
