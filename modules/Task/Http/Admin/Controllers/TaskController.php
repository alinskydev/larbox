<?php

namespace Modules\Task\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Task\Models\Task;
use Modules\Task\Search\TaskSearch;
use Modules\Task\Resources\TaskResource;
use Modules\Task\Http\Admin\Requests\TaskRequest;

class TaskController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Task(),
            search: new TaskSearch(),
            resourceClass: TaskResource::class
        );
    }

    public function store(TaskRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(TaskRequest $request)
    {
        return $this->save($request, 200);
    }
}
