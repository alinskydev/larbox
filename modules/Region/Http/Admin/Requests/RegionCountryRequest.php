<?php

namespace Modules\Region\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Region\Models\RegionCountry;

use App\Helpers\FormRequestHelper;

class RegionCountryRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new RegionCountry()
        );
    }

    public function rules()
    {
        return FormRequestHelper::createLocalizationRules([
            'name' => 'required|string|max:100',
        ]);
    }
}
