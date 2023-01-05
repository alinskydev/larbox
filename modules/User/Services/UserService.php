<?php

namespace Modules\User\Services;

use App\Base\ActiveService;
use Modules\User\Models\User;

/**
 * @property User $model
 */
class UserService extends ActiveService
{
    public function createNewAccessToken(): void
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
