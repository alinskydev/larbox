<?php

namespace Modules\Shop\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Shop\Models\ShopContact;
use Modules\Shop\Search\ShopContactSearch;
use Modules\Shop\Resources\ShopContactResource;
use Modules\Shop\Http\Public\Requests\ShopContactRequest;

class ShopContactController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopContact(),
            search: new ShopContactSearch(),
            resourceClass: ShopContactResource::class
        );
    }

    public function store(ShopContactRequest $request)
    {
        return $this->save($request, 201);
    }
}
