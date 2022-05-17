<?php

namespace Modules\Shop\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Shop\Models\ShopSupplier;

use App\Helpers\FormRequestHelper;
use App\Rules\ExistsSoftDeleteRule;

class ShopSupplierRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopSupplier()
        );
    }

    public function rules()
    {
        return [
            'country_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'region_country'),
            ],
            'short_name' => 'required|string|max:100',
            'full_name' => 'required|string|max:100',
        ];
    }
}
