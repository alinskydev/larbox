<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Http\Admin\User\Requests\UserRequest;

class UserController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new User(),
            search: new UserSearch(),
            formRequestClass: UserRequest::class,
        );
    }
}
