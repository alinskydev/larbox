<?php

namespace Modules\Product\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductVariation;
use Modules\Product\Search\ProductVariationSearch;
use Modules\Product\Resources\ProductVariationResource;
use Modules\Product\Http\Admin\Requests\ProductVariationRequest;

class ProductVariationController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductVariation(),
            search: new ProductVariationSearch(),
            resourceClass: ProductVariationResource::class
        );
    }

    public function store(ProductVariationRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ProductVariationRequest $request)
    {
        return $this->save($request, 200);
    }
}
