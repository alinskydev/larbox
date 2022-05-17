<?php

namespace Modules\Product\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductBrand;
use Modules\Product\Search\ProductBrandSearch;
use Modules\Product\Resources\ProductBrandResource;
use Modules\Product\Http\Admin\Requests\ProductBrandRequest;

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

    public function update(ProductBrandRequest $request)
    {
        return $this->save($request, 200);
    }
}
