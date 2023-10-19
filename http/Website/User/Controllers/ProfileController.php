<?php

namespace Http\Website\User\Controllers;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

use Modules\User\Resources\UserResource;
use Http\Website\User\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show(): Response
    {
        return response()->json(UserResource::make(request()->user()), 200);
    }

    public function update(ProfileRequest $request): Response
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponseWithAccessToken($request->model);
    }
}
