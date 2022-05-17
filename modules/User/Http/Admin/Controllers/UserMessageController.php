<?php

namespace Modules\User\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\User\Models\UserMessage;
use Modules\User\Search\UserMessageSearch;
use Modules\User\Resources\UserMessageResource;
use Modules\User\Http\Admin\Requests\UserMessageRequest;

class UserMessageController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new UserMessage(),
            search: new UserMessageSearch(),
            resourceClass: UserMessageResource::class
        );
    }

    public function store(UserMessageRequest $request)
    {
        return $this->save($request, 201);
    }
}
