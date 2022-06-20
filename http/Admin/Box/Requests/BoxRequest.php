<?php

namespace Http\Admin\Box\Requests;

use App\Helpers\FormRequestHelper;
use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\ExistsWithOldRule;

use Modules\Box\Models\Brand;
use Modules\Box\Models\Tag;

class BoxRequest extends ActiveFormRequest
{
    protected array $ignoredModelUpdateFields = [
        'image',
        'images_list',
    ];

    public function classicRules()
    {
        return [
            'brand_id' => [
                'required',
                new ExistsWithOldRule($this->model, Brand::class, 'brand_id', extraQuery: function ($query) {
                    $query->whereHas('creator', function ($subQuery) {
                        $subQuery->where('id', auth()->user()->id);
                    });
                }),
            ],

            'date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'image' => FormRequestHelper::imageRules(),
            'images_list' => 'array',
            'images_list.*' => FormRequestHelper::imageRules(),

            'tags' => [
                'array',
                new ExistsWithOldRule($this->model, Tag::class, 'tags.*.id'),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
            'variations.*.date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'variations.*.datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'variations.*.image' => FormRequestHelper::imageRules(),
            'variations.*.images_list' => 'array',
            'variations.*.images_list.*' => FormRequestHelper::imageRules(),
        ];
    }

    public function localizedRules()
    {
        return [
            'name' => 'required|string|max:100',
            'variations.*.name' => 'required|string|max:100',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_MANY => [
                'variations' => $data['variations'] ?? [],
            ],
            $this->model::RELATION_TYPE_MANY_MANY => [
                'tags' => $data['tags'] ?? [],
            ],
        ];

        return $data;
    }
}
