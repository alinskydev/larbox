<?php

namespace Http\Admin\Box\Controllers;

use App\NestedSet\NestedSetController;
use Illuminate\Http\JsonResponse;

use Modules\Box\Models\Category;
use Modules\Box\Search\CategorySearch;
use Modules\Box\Resources\CategoryResource;
use Http\Admin\Box\Requests\CategoryRequest;

class CategoryController extends NestedSetController
{
    public function __construct()
    {
        parent::__construct(
            model: new Category(),
            search: new CategorySearch(),
            resourceClass: CategoryResource::class,
            formRequestClass: CategoryRequest::class,
        );
    }
}
