<?php

namespace App\Base;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;

use Modules\User\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse(int $status = 200): JsonResponse
    {
        return response()->json(['message' => 'Success'], $status);
    }

    protected function successResponseWithAccessToken(User $user, int $status = 200): JsonResponse
    {
        if (isset($user->newAccessToken) && (!request()->user() || $user->id === request()->user()->id)) {
            return response()->json(['token' => $user->newAccessToken], $status);
        } else {
            return $this->successResponse($status);
        }
    }
}
