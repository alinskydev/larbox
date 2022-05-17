<?php

namespace Modules\Product\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\Product;
use Modules\Product\Search\ProductSearch;
use Modules\Product\Resources\ProductResource;
use Modules\Product\Http\Public\Requests\ProductRequest;

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
}
