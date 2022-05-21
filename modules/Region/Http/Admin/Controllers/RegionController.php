<?php

namespace Modules\Region\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\Region\Models\Region;
use Modules\Region\Search\RegionSearch;
use Modules\Region\Http\Admin\Requests\RegionRequest;

class RegionController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Region(),
            search: new RegionSearch(),
            formRequestClass: RegionRequest::class,
        );
    }
}
