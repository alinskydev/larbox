<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;

use Illuminate\Validation\Rule;
use App\Rules\ExistsSoftDeleteRule;
use App\Rules\FileRule;

class BoxRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'image',
        'images_list',
        'variations.*.image',
        'variations.*.images_list',
    ];

    public function classicRules()
    {
        return [
            'brand_id' => [
                'required',
                new ExistsSoftDeleteRule($this->model, 'box_brand'),
            ],

            'date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'image' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
            'images_list' => 'array',
            'images_list.*' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
            'variations.*.date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'variations.*.datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'variations.*.image' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],
            'variations.*.images_list' => 'array',
            'variations.*.images_list.*' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.image')),
            ],

            'tags' => [
                'array',
                new ExistsSoftDeleteRule($this->model, 'box_tag'),
            ],
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
