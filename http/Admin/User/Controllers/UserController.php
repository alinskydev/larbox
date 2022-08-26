<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Resources\UserResource;
use Http\Admin\User\Requests\UserRequest;

class UserController extends ActiveController
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
