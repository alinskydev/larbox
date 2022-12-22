<?php

namespace Http\Website\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;

use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Website\Box\Requests\BrandRequest;

use Modules\User\Scopes\UserScope;

class BrandController extends ResourceController
{
    public function __construct()
    {
        Brand::setRouteKeyName('slug');

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
