<?php

namespace App\Base;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\User\Models\User;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successResponse(int $status = 200): Response
    {
        return response()->json(['message' => 'Success'], $status);
    }

    protected function successResponseWithAccessToken(User $user, int $status = 200): Response
    {
        if (isset($user->newAccessToken) && (!request()->user() || $user->id === request()->user()->id)) {
            return response()->json(['token' => $user->newAccessToken], $status);
        } else {
            return $this->successResponse($status);
        }
    }

    protected function streamedResponse(string $data, string $extension): Response
    {
        return response()->streamDownload(
            callback: function () use ($data) {
                echo $data;
            },
            name: hexdec(uniqid()) . ($extension ? ".$extension" : ''),
        );
    }
}
