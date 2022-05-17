<?php

namespace Modules\Shop\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Shop\Models\Shop;
use Modules\Shop\Search\ShopSearch;
use Modules\Shop\Resources\ShopResource;
use Modules\Shop\Http\Admin\Requests\ShopRequest;

class ShopController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Shop(),
            search: new ShopSearch(),
            resourceClass: ShopResource::class
        );
    }

    public function store(ShopRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ShopRequest $request)
    {
        return $this->save($request, 200);
    }
}
