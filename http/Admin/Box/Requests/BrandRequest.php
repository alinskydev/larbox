<?php

namespace Http\Admin\Box\Requests;

use App\Helpers\FormRequestHelper;
use App\Http\Requests\ActiveFormRequest;
use Modules\Box\Models\Brand;

use Illuminate\Validation\Rule;
use App\Rules\FileRule;
use App\Rules\SlugRule;

class BrandRequest extends ActiveFormRequest
{
    protected array $fileFields = [
        'file' => 'files',
        'files_list' => 'files',
    ];

    public function __construct()
    {
        return parent::__construct(
            model: new Brand()
        );
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => [
                'required',
                new SlugRule($this->model),
            ],
            'file' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.all')),
            ],
            'files_list' => 'array',
            'files_list.*' => [
                'sometimes',
                'required',
                new FileRule(mimes: config('larbox.form_request.file.mimes.all')),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        parent::prepareForValidation();

        $this->merge([
            'slug' => FormRequestHelper::slug($this->slug, $this->name, isLocalized: false),
        ]);
    }
}
