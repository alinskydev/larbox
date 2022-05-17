<?php

namespace Modules\Shop\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Shop\Models\Shop;
use App\Models\Model;

use App\Helpers\FormRequestHelper;
use App\Rules\ExistsSoftDeleteRule;
use Modules\User\Services\UserService;

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
            'city_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'region_city', extraQuery: function ($query) {
                    $user = auth()->user();

                    // Made this check just to ignore editor error
                    if ($user instanceof Model) {
                        $userService = new UserService($user);
                    }

                    $query->whereIn('id', $userService->availableCities());
                }),
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
                new ExistsSoftDeleteRule($this->model, 'shop_supplier', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
            ],
            'contacts' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'shop_contact', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
            ],
            'brands' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'product_brand', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
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
