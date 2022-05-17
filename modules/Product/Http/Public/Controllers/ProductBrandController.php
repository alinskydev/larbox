<?php

namespace Modules\Product\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductBrand;
use Modules\Product\Search\ProductBrandSearch;
use Modules\Product\Resources\ProductBrandResource;
use Modules\Product\Http\Public\Requests\ProductBrandRequest;

class ProductBrandController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductBrand(),
            search: new ProductBrandSearch(),
            resourceClass: ProductBrandResource::class
        );
    }

    public function store(ProductBrandRequest $request)
    {
        return $this->save($request, 201);
    }
}
