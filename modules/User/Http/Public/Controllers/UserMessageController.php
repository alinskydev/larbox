<?php

namespace Modules\User\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\User\Models\UserMessage;
use Modules\User\Search\UserMessageSearch;
use Modules\User\Resources\UserMessageResource;
use Modules\User\Http\Public\Requests\UserMessageRequest;

class UserMessageController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new UserMessage(),
            search: new UserMessageSearch(),
            resourceClass: UserMessageResource::class
        );

        $this->middleware(function ($request, $next) {
            $this->search->queryBuilder->where('user_id', auth()->user()->id);
            return $next($request);
        });
    }

    public function store(UserMessageRequest $request)
    {
        return $this->save($request, 201);
    }
}
