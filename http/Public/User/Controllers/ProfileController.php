<?php

namespace Http\Public\User\Controllers;

use App\Http\Controllers\Controller;
use App\Resources\JsonResource;
use Http\Public\User\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $response = JsonResource::make(auth()->user());
        return response()->json($response, 200);
    }

    public function update(ProfileRequest $request)
    {
        $response = [];
        
        if ($request->new_password) {
            $response['token'] = 'Basic ' . base64_encode("$request->username:$request->new_password");
        }

        $response['data'] = JsonResource::make($request->model);

        return response()->json($response, 200);
    }
}
