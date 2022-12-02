<?php

namespace Http\Website\User\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Modules\User\Resources\UserResource;
use Http\Website\User\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json(UserResource::make(auth()->user()), 200);
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        return $this->successResponse();
    }
}
