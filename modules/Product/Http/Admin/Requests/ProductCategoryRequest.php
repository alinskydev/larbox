<?php

namespace Modules\Product\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Product\Models\ProductCategory;

use App\Rules\ExistsSoftDeleteRule;
use App\Helpers\FormRequestHelper;

class ProductCategoryRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductCategory()
        );
    }

    public function rules()
    {
        return array_merge(
            [
                'specifications' => [
                    'array',
                    new ExistsSoftDeleteRule($this->model, 'product_specification'),
                ],
            ],
            FormRequestHelper::createLocalizationRules([
                'name' => 'required|string|max:100',
            ])
        );
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_MANY_MANY => [
                'specifications' => $this->specifications,
            ],
        ];
    }
}
