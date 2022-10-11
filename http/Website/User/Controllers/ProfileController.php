<?php

namespace Http\Website\User\Controllers;

use App\Http\Controllers\Controller;
use Http\Website\User\Requests\ProfileRequest;
use Modules\User\Resources\UserResource;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(UserResource::make(auth()->user()), 200);
    }

    public function update(ProfileRequest $request)
    {
        return $this->successResponse();
    }
}