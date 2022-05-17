<?php

namespace Modules\Task\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Task\Models\Task;
use Modules\Task\Search\TaskSearch;
use Modules\Task\Resources\TaskResource;

class TaskController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Task(),
            search: new TaskSearch(),
            resourceClass: TaskResource::class
        );

        $this->middleware(function ($request, $next) {
            $this->search->queryBuilder->where('agent_id', auth()->user()->id);
            return $next($request);
        });
    }
}
