<?php

namespace Http\Public\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Public\Box\Requests\BrandRequest;

use Modules\User\Scopes\UserScope;

class BrandController extends ActiveController
{
    public function __construct()
    {
        Brand::addGlobalScope(new UserScope('creator_id'));

        return parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );
    }
}
