<?php

namespace Modules\Shop\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Shop\Models\Shop;
use Modules\Shop\Search\ShopSearch;
use Modules\Shop\Resources\ShopResource;
use Modules\Shop\Http\Public\Requests\ShopRequest;

class ShopController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Shop(),
            search: new ShopSearch(),
            resourceClass: ShopResource::class
        );

        $this->middleware(function ($request, $next) {
            $this->search->queryBuilder->where('agent_id', auth()->user()->id);
            return $next($request);
        });
    }

    public function store(ShopRequest $request)
    {
        return $this->save($request, 201);
    }
}
