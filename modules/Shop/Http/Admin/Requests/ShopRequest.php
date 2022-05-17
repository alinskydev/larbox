<?php

namespace Modules\Shop\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Shop\Models\Shop;

use App\Helpers\FormRequestHelper;
use App\Rules\ExistsSoftDeleteRule;

class ShopRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new Shop()
        );
    }

    public function rules()
    {
        return [
            'agent_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'user', extraQuery: function ($query) {
                    $query->where('role', 'agent');
                }),
            ],
            'city_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'region_city'),
            ],
            'company_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'shop_company'),
            ],
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:1000',
            'has_credit_line' => 'required|boolean',

            'location' => 'required|array|size:2',
            'location.*' => 'numeric',

            'suppliers' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'shop_supplier'),
            ],
            'contacts' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'shop_contact'),
            ],
            'brands' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'product_brand'),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $this->merge([
            'location' => array_values((array)$this->location),
        ]);
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_MANY_MANY => [
                'suppliers' => $this->suppliers,
                'contacts' => $this->contacts,
                'brands' => $this->brands,
            ],
        ];
    }
}
