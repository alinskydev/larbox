<?php

namespace Modules\Shop\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Shop\Models\ShopSupplier;
use Modules\Shop\Search\ShopSupplierSearch;
use Modules\Shop\Resources\ShopSupplierResource;
use Modules\Shop\Http\Public\Requests\ShopSupplierRequest;

class ShopSupplierController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopSupplier(),
            search: new ShopSupplierSearch(),
            resourceClass: ShopSupplierResource::class
        );
    }

    public function store(ShopSupplierRequest $request)
    {
        return $this->save($request, 201);
    }
}
