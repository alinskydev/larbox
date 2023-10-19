<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Symfony\Component\HttpFoundation\Response;

use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Resources\UserResource;
use Http\Admin\User\Requests\UserRequest;

use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class UserController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new User(),
            search: new UserSearch(),
            resourceClass: UserResource::class,
            formRequestClass: UserRequest::class,
        );
    }

    public function update(ValidatesWhenResolved $request): Response
    {
        parent::update($request);
        return $this->successResponseWithAccessToken($request->model);
    }
}
