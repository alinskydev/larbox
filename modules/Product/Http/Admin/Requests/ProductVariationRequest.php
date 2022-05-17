<?php

namespace Modules\Product\Http\Admin\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Product\Models\ProductVariation;
use Modules\Product\Models\ProductSpecificationOption;

use Illuminate\Validation\Rule;
use App\Rules\ExistsSoftDeleteRule;
use App\Helpers\FormRequestHelper;

class ProductVariationRequest extends ActiveFormRequest
{
    protected array $ignoredModelFields = ['images_list'];
    protected array $fileFields = [
        'images_list' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new ProductVariation()
        );
    }

    public function rules()
    {
        return [
            'product_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'product'),
            ],
            'sku' => [
                'required',
                Rule::unique($this->model->getTable())->ignore($this->model->id)->where('product_id', $this->product_id),
            ],
            'images_list' => 'array',
            'images_list.*' => 'file|max:1024|mimes:jpg,png,webp',

            'options' => [
                'required',
                'array',
                'exists:product_specification_option,id',
            ],
        ];
    }

    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $options = ProductSpecificationOption::query()->whereIn('id', $this->options)->get()->toArray();
                $specifications_ids = data_get($options, '*.specification_id');
                $specifications_ids = array_flip($specifications_ids);

                if (count($options) != count($specifications_ids)) {
                    $validator->errors()->add('options', 'rules.product_variation.options.specification_single_option');
                }
            });
        }
    }

    protected  function passedValidation()
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_MANY_MANY => [
                'options' => $this->options,
            ],
        ];
    }
}
