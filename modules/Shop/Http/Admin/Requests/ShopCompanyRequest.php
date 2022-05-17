<?php

namespace Modules\Shop\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Shop\Models\ShopCompany;

use App\Helpers\FormRequestHelper;

class ShopCompanyRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopCompany()
        );
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
        ];
    }
}
