<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Admin\Box\Requests\BrandRequest;

class BrandController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );
    }
}
