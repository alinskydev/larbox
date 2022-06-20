<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Admin\Box\Requests\BrandRequest;

class BrandController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );
    }
}
