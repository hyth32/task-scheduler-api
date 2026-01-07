<?php

namespace App\Services\Auth;

use App\Models\User;

class RegisterService
{
    public function __construct(private TokenService $tokenService) {}

    public function handle(array $data): array
    {
        $user = User::create($data);

        $tokens = $this->tokenService->createTokens($user);

        return array_merge(['user' => $user], $tokens);
    }
}
