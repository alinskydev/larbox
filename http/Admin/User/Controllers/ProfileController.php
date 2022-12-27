<?php

namespace Http\Admin\User\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Modules\User\Resources\UserResource;
use Http\Admin\User\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json(UserResource::make(request()->user()), 200);
    }

    public function update(ProfileRequest $request): JsonResponse
    {
        $request->model->safelySave($request->validatedData);

        if ($request->model->newAccessToken) {
            return response()->json(['token' => $request->model->newAccessToken], 200);
        } else {
            return $this->successResponse();
        }
    }
}
