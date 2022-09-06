<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Resources\UserResource;
use Http\Admin\User\Requests\UserRequest;

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
}
