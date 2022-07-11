<?php

namespace Modules\Page\Requests;

use App\Http\Requests\FormRequest;
use Modules\Page\Models\Page;

use App\Helpers\Validation\FileValidationHelper;
use App\Helpers\FileHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class HomeRequest extends FormRequest
{
    public Page $model;

    public function __construct()
    {
        $this->model = request()->route()->controller->model;
        return parent::__construct();
    }

    public function nonLocalizedRules()
    {
        return [
            'welcome_slogan' => 'required|string|max:100',
            'welcome_image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
            'images_list' => 'array',
            'images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'slider' => 'required|array',
            'slider.*.image' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),

            'portfolio' => 'required|array',
            'portfolio.*.name' => 'required|string|max:100',
            'portfolio.*.images_list' => 'array',
            'portfolio.*.images_list.*' => FileValidationHelper::rules(FileValidationHelper::CONFIG_IMAGE),
        ];
    }

    public function localizedRules()
    {
        return [
            'welcome_title' => 'required|string|max:100',
            'welcome_description' => 'present|string',

            'slider.*.title' => 'required|string|max:100',
            'slider.*.subtitle' => 'required|string|max:100',

            'portfolio.*.description' => 'present|string',
        ];
    }

    protected function passedValidation()
    {
        parent::passedValidation();

        $this->model->blocks = $this->validated();
        $this->model->save();
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        // $data['slider'] = array_values($data['slider']);
        // $data['portfolio'] = array_values($data['portfolio']);

        $data = $this->saveFiles($data);

        $oldBlocks = $this->model->getRawOriginal('blocks');
        $oldBlocks = json_decode($oldBlocks, true);

        $data = array_replace_recursive($oldBlocks, $data);

        data_fill($data['slider'], '*.image', null);
        data_fill($data['portfolio'], '*.images_list', []);

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        return $data;
    }

    private function saveFiles($data)
    {
        $data = Arr::dot($data);

        foreach ($data as &$value) {
            if ($value instanceof UploadedFile) {
                $value = FileHelper::upload($value, 'images');
            }
        }

        $data = Arr::undot($data);

        return $data;
    }
}
