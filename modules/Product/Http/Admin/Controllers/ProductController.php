<?php

namespace Modules\Product\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\Product;
use Modules\Product\Search\ProductSearch;
use Modules\Product\Resources\ProductResource;
use Modules\Product\Http\Admin\Requests\ProductRequest;

class ProductController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Product(),
            search: new ProductSearch(),
            resourceClass: ProductResource::class
        );
    }

    public function store(ProductRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ProductRequest $request)
    {
        return $this->save($request, 200);
    }
}
