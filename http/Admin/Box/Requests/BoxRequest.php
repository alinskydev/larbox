<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\FileValidationHelper;

use Modules\Box\Models\Brand;
use Modules\Box\Models\Category;
use Modules\Box\Models\Tag;

class BoxRequest extends ActiveFormRequest
{
    use SeoMetaFormRequestTrait;

    public function nonLocalizedRules(): array
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

            'categories' => [
                'required',
                'array',
                new ExistsWithOldRule($this->model, Category::class, 'categories.*.id'),
            ],

            'tags' => [
                'array',
                new ExistsWithOldRule($this->model, Tag::class, 'tags.*.id'),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
            'variations.*.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function localizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule($this->model),
            ],
            'description' => 'present|nullable|string',

            'variations.*.name' => 'required|string|max:255',
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $this->model->fillableRelations = [
            $this->model::RELATION_TYPE_ONE_MANY => [
                'variations' => $this->validatedData['variations'] ?? [],
            ],
            $this->model::RELATION_TYPE_MANY_MANY => [
                'categories' => $this->validatedData['categories'] ?? [],
                'tags' => $this->validatedData['tags'] ?? [],
            ],
        ];
    }
}
