<?php

namespace Modules\Product\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Product\Models\ProductSpecification;
use Modules\Product\Search\ProductSpecificationSearch;
use Modules\Product\Resources\ProductSpecificationResource;
use Modules\Product\Http\Admin\Requests\ProductSpecificationRequest;

class ProductSpecificationController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductSpecification(),
            search: new ProductSpecificationSearch(),
            resourceClass: ProductSpecificationResource::class
        );
    }

    public function store(ProductSpecificationRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ProductSpecificationRequest $request)
    {
        return $this->save($request, 200);
    }
}
