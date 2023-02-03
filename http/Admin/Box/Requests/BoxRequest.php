<?php

namespace Http\Admin\Box\Requests;

use App\Http\Requests\ActiveFormRequest;
use Modules\Seo\Traits\SeoMetaFormRequestTrait;

use Illuminate\Validation\Rule;
use App\Rules\UniqueRule;
use App\Rules\ExistsWithOldRule;
use App\Helpers\Validation\ValidationFileRulesHelper;

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
                    query: Brand::query()->where('is_active', 1)
                        ->whereHas('creator', function ($query) {
                            $query->where('id', request()->user()->id);
                        }),
                ),
            ],
            'price' => 'required|integer|min:0',
            'date' => 'required|date|date_format:' . config('larbox.formats.date'),
            'datetime' => 'required|date|date_format:' . config('larbox.formats.datetime'),
            ...$this->deleteableFileFieldsSingleValidation(
                field: 'image',
                rules: ValidationFileRulesHelper::image(!$this->model->exists),
            ),
            ...$this->deleteableFileFieldsMultipleValidation(
                field: 'images_list',
                rules: ValidationFileRulesHelper::image(!$this->model->exists),
            ),

            'categories' => [
                'required',
                'array',
                new ExistsWithOldRule(
                    model: $this->model,
                    query: Category::query(),
                ),
            ],

            'tags' => [
                'array',
                new ExistsWithOldRule(
                    model: $this->model,
                    query: Tag::query(),
                ),
            ],

            'variations' => 'array',
            'variations.*.id' => 'integer',
            ...$this->deleteableFileFieldsSingleValidation(
                field: 'variations.*.image',
                rules: ValidationFileRulesHelper::image(),
            ),
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
