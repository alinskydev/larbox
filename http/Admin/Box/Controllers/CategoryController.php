<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\Box\Models\Category;
use Modules\Box\Search\CategorySearch;
use Modules\Box\Resources\CategoryResource;
use Http\Admin\Box\Requests\CategoryRequest;

class CategoryController extends ResourceController
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

    public function tree()
    {
        $model = $this->model->newQuery()->withoutGlobalScopes()->with('children')->findOrFail(1);
        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }
}
