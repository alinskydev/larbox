<?php

namespace Http\Public\Box\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Public\Box\Requests\BrandRequest;

use Modules\User\Scopes\UserScope;

class BrandController extends ApiResourceController
{
    public function __construct()
    {
        app()->bind(Brand::class, fn () => (new Brand())->setRouteKeyName('slug'));

        Brand::addGlobalScope(new UserScope('creator_id'));

        Brand::addGlobalScope(function ($query) {
            $query->withoutTrashed();
        });

        parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );
    }
}
