<?php

namespace Modules\Region\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Region\Models\RegionCity;
use Modules\Region\Search\RegionCitySearch;
use Modules\Region\Resources\RegionCityResource;
use Modules\Region\Http\Admin\Requests\RegionCityRequest;

class RegionCityController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new RegionCity(),
            search: new RegionCitySearch(),
            resourceClass: RegionCityResource::class
        );
    }

    public function store(RegionCityRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(RegionCityRequest $request)
    {
        return $this->save($request, 200);
    }
}
