<?php

namespace Http\Website\Box\Controllers;

use App\Hierarchy\HierarchyController;
use Modules\Box\Models\Category;
use Modules\Box\Search\CategorySearch;
use Modules\Box\Resources\CategoryResource;

class CategoryController extends HierarchyController
{
    public function __construct()
    {
        Category::addGlobalScope(function ($query) {
            $query->withoutTrashed();
        });

        parent::__construct(
            model: new Category(),
            search: new CategorySearch(),
            resourceClass: CategoryResource::class,
        );
    }
}
