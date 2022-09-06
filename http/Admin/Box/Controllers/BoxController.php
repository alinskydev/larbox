<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\Box\Models\Box;
use Modules\Box\Search\BoxSearch;
use Modules\Box\Resources\BoxResource;
use Http\Admin\Box\Requests\BoxRequest;

class BoxController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Box(),
            search: new BoxSearch(),
            resourceClass: BoxResource::class,
            formRequestClass: BoxRequest::class,
        );
    }
}
