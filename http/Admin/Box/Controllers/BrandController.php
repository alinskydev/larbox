<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Http\Admin\Box\Requests\BrandRequest;

class BrandController extends ActiveController
{
    public function __construct()
    {
        $model = Brand::query()->find(3);
        $files = $model->file;
        $model->file = $files;
        $model->save();

        return parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            formRequestClass: BrandRequest::class,
        );
    }
}
