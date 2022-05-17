<?php

namespace Modules\User\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\User\Models\User;
use Modules\User\Search\UserSearch;
use Modules\User\Resources\UserResource;
use Modules\User\Http\Admin\Requests\UserRequest;

use Illuminate\Support\Arr;

class UserController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new User(),
            search: new UserSearch(),
            resourceClass: UserResource::class
        );

        $showQuery = (array)request()->get('show');
        $showQuery = Arr::flatten($showQuery);

        if (in_array('messages_count', $showQuery)) {
            $this->search->queryBuilder->withCount('messages');
        }
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
