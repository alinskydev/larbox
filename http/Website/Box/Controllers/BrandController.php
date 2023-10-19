<?php

namespace Http\Website\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Http\Website\Box\Filters\BrandFilter;
use Symfony\Component\HttpFoundation\Response;

use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Website\Box\Requests\BrandRequest;

class BrandController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            filter: new BrandFilter(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );
    }
}
