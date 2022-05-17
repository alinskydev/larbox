<?php

namespace Modules\Product\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductVariation;
use Modules\Product\Search\ProductVariationSearch;
use Modules\Product\Resources\ProductVariationResource;
use Modules\Product\Http\Public\Requests\ProductVariationRequest;

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
}
