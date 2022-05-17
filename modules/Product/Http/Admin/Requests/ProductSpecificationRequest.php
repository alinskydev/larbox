<?php

namespace Modules\Product\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Product\Models\ProductSpecification;

use App\Helpers\FormRequestHelper;

class ProductSpecificationRequest extends ActiveFormRequest
{
    public function __construct()
    {
        return parent::__construct(
            model: new ProductSpecification()
        );
    }

    public function rules()
    {
        return array_merge(
            [
                'options' => 'required|array',
                'options.*.id' => 'integer',
            ],
            FormRequestHelper::createLocalizationRules([
                'name' => 'required|string|max:100',
                'options.*.name' => 'required|string|max:100',
            ])
        );
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_MANY => [
                'options' => $this->options,
            ],
        ];
    }
}
