<?php

namespace Modules\Region\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Region\Models\RegionCity;

use App\Rules\ExistsSoftDeleteRule;
use App\Helpers\FormRequestHelper;

class RegionCityRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new RegionCity()
        );
    }

    public function rules()
    {
        return array_merge(
            [
                'region_id' => [
                    'required',
                    new ExistsSoftDeleteRule($this->model, 'region'),
                ],
            ],
            FormRequestHelper::createLocalizationRules([
                'name' => 'required|string|max:100',
            ])
        );
    }
}
