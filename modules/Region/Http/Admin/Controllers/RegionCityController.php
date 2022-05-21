<?php

namespace Modules\Region\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\Region\Models\RegionCity;
use Modules\Region\Search\RegionCitySearch;
use Modules\Region\Http\Admin\Requests\RegionCityRequest;

class RegionCityController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new RegionCity(),
            search: new RegionCitySearch(),
            formRequestClass: RegionCityRequest::class,
        );
    }
}
