<?php

namespace Modules\Product\Http\Public\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Product\Models\Product;

use Illuminate\Validation\Rule;
use App\Rules\ExistsSoftDeleteRule;
use App\Helpers\FormRequestHelper;

class ProductRequest extends ActiveFormRequest
{
    protected array $ignoredModelFields = ['images_list'];
    protected array $fileFields = [
        'images_list' => 'images',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new Product()
        );
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'product_category'),
            ],
            'brand_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'product_brand', extraQuery: function ($query) {
                    $query->where('is_active', 1);
                }),
            ],

            'model_number' => 'required|string|max:100',
            'sku' => [
                'required',
                Rule::unique($this->model->getTable())->ignore($this->model->id),
            ],
            'date_eol' => 'required|date|date_format:d.m.Y',
            'images_list' => 'array',
            'images_list.*' => 'file|max:1024|mimes:jpg,png,webp',
        ];
    }
}
