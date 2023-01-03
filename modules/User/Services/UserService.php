<?php

namespace Modules\User\Services;

use Modules\User\Models\User;

class UserService
{
    public function __construct(private User $model)
    {
    }

    public function assignNewAccessToken(): void
    {
        $token = $this->model
            ->createToken(
                name: 'default',
                expiresAt: now()->addWeek(),
            )
            ->plainTextToken;

        $this->model->newAccessToken = "Bearer $token";
    }
}
