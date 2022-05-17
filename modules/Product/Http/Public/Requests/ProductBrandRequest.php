<?php

namespace Modules\Product\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Product\Models\ProductBrand;

use App\Helpers\FormRequestHelper;

class ProductBrandRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductBrand()
        );
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
        ];
    }
}
