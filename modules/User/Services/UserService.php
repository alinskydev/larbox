<?php

namespace Modules\User\Services;

use App\Base\ActiveService;

class UserService extends ActiveService
{
    public function assignNewAccessToken(): void
    {
        $token = $this->model
            ->createToken(
                name: 'default',
                expiresAt: now()->addMonth(),
            )
            ->plainTextToken;

        $this->model->newAccessToken = "Bearer $token";
    }
}
