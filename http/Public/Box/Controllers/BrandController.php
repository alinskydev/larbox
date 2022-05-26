<?php

namespace Http\Public\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Http\Public\Box\Requests\BrandRequest;

use App\Scopes\OwnerScope;

class BrandController extends ActiveController
{
    public function __construct()
    {
        Brand::addGlobalScope(new OwnerScope());

        return parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            formRequestClass: BrandRequest::class,
        );
    }
}
