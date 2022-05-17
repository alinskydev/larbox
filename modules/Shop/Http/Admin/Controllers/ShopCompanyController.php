<?php

namespace Modules\Shop\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Shop\Models\ShopCompany;
use Modules\Shop\Search\ShopCompanySearch;
use Modules\Shop\Resources\ShopCompanyResource;
use Modules\Shop\Http\Admin\Requests\ShopCompanyRequest;

class ShopCompanyController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopCompany(),
            search: new ShopCompanySearch(),
            resourceClass: ShopCompanyResource::class
        );
    }

    public function store(ShopCompanyRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ShopCompanyRequest $request)
    {
        return $this->save($request, 200);
    }
}
