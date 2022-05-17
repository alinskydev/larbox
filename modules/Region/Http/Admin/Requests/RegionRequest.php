<?php

namespace Modules\Region\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Region\Models\Region;

use App\Helpers\FormRequestHelper;

class RegionRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new Region()
        );
    }

    public function rules()
    {
        return FormRequestHelper::createLocalizationRules([
            'name' => 'required|string|max:100',
        ]);
    }
}
