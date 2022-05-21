<?php

namespace Modules\Region\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\Region\Models\RegionCountry;
use Modules\Region\Search\RegionCountrySearch;
use Modules\Region\Http\Admin\Requests\RegionCountryRequest;

class RegionCountryController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new RegionCountry(),
            search: new RegionCountrySearch(),
            formRequestClass: RegionCountryRequest::class,
        );
    }
}
