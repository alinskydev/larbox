<?php

namespace Modules\User\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Http\Admin\Requests\UserRequest;

class UserController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new User(),
            search: new UserSearch(),
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
