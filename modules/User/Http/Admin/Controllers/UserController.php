<?php

namespace Modules\User\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Resources\UserResource;
use Modules\User\Http\Admin\Requests\UserRequest;

class UserController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new User(),
            search: new UserSearch(),
            resourceClass: UserResource::class
        );
    }

    public function store(UserRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(UserRequest $request)
    {
        return $this->save($request, 200);
    }
}
