<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\ValidationFileHelper;

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
                new ExistsWithOldRule(
                    model: $this->model,
                    relationClass: Brand::class,
                    extraQuery: function ($query) {
                        $query->where('is_active', 1)
                            ->whereHas('creator', function ($subQuery) {
                                $subQuery->where('id', auth()->user()->id);
                            });
                    },
                ),
            ],
            'price' => 'required|integer|min:0',
            'date' => 'required|date|date_format:' . LARBOX_FORMAT_DATE,
            'datetime' => 'required|date|date_format:' . LARBOX_FORMAT_DATETIME,
            'image' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
            'images_list' => 'array',
            'images_list.*' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),

            'categories' => [
                'required',
                'array',
                new ExistsWithOldRule(
                    model: $this->model,
                    relationClass: Category::class,
                ),
            ],

            'tags' => [
                'array',
                new ExistsWithOldRule(
                    model: $this->model,
                    relationClass: Tag::class,
                ),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
            'variations.*.image' => ValidationFileHelper::rules(ValidationFileHelper::CONFIG_IMAGE),
        ];
    }

    public function localizedRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueRule(
                    model: $this->model,
                    fieldIsLocalized: true,
                ),
            ],
            'description' => 'present|nullable|string',

            'variations.*.name' => 'required|string|max:255',
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $this->model->fillRelations(
            oneToMany: [
                'variations' => $this->validatedData['variations'] ?? [],
            ],
            manyToMany: [
                'categories' => $this->validatedData['categories'] ?? [],
                'tags' => $this->validatedData['tags'] ?? [],
            ],
        );
    }
}
