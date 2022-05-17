<?php

namespace Modules\Shop\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Shop\Models\ShopContact;

use App\Helpers\FormRequestHelper;

class ShopContactRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ShopContact()
        );
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'second_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'position' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
        ];
    }
}
