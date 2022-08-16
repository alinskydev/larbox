<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\FileValidationHelper;
use Modules\Box\Models\Brand;
use Modules\Box\Models\Tag;

class BoxRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function nonLocalizedRules()
    {
        return [
            'brand_id' => [
                'required',
                new ExistsWithOldRule($this->model, Brand::class, 'brand_id', extraQuery: function ($query) {
                    $query->where('is_active', 1)
                        ->whereHas('creator', function ($subQuery) {
                            $subQuery->where('id', auth()->user()->id);
                        });
                }),
            ],

            'price' => 'required|integer|min:0',
            'date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'images_list' => 'array',
            'images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'tags' => [
                'array',
                new ExistsWithOldRule($this->model, Tag::class, 'tags.*.id'),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
        ];
    }

    public function localizedRules()
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',

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
