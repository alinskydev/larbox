<?php

namespace Modules\Product\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductCategory;
use Modules\Product\Search\ProductCategorySearch;
use Modules\Product\Resources\ProductCategoryResource;
use Modules\Product\Http\Admin\Requests\ProductCategoryRequest;

class ProductCategoryController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductCategory(),
            search: new ProductCategorySearch(),
            resourceClass: ProductCategoryResource::class
        );
    }

    public function store(ProductCategoryRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ProductCategoryRequest $request)
    {
        return $this->save($request, 200);
    }
}
