<?php

namespace App\Services\Auth;

use App\Models\User;

class LogoutService
{
    public function handle(User $user): array
    {
        $user->currentAccessToken()->delete();

        return [
            'success' => true,
            'message' => 'Logged out successfully',
        ];
    }
}
