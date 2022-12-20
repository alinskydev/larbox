<?php

namespace App\Http\Requests\ActiveFormRequest;

use App\Helpers\Validation\ValidationFileHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait DeleteableFileFieldsTrait
{
    private array $deleteableFileFields = [
        'single' => [],
        'multiple' => [],
    ];

    public function deleteableFileFieldsSingleValidation(
        string $field,
        array $config,
        bool $isRequired = false,
    ): array {
        $this->deleteableFileFields['single'][] = $field;

        return [
            $field => ValidationFileHelper::rules($config, $isRequired),
            "{$field}_old_keys" => 'required|json',
        ];
    }

    public function deleteableFileFieldsMultipleValidation(
        string $field,
        array $config,
        bool $isRequired = false,
    ): array {
        $this->deleteableFileFields['multiple'][] = $field;

        return [
            $field => array_merge(
                [
                    'required',
                    'array',
                ],
                !$isRequired ? ['sometimes'] : [],
            ),
            "$field.*" => ValidationFileHelper::rules($config),
            "{$field}_old_keys" => 'required|json',
        ];
    }

    private function deleteableFileFieldsProcess(): void
    {
        $this->validatedData = Arr::dot($this->validatedData);

        $single = array_unique($this->deleteableFileFields['single']);
        $multiple = array_unique($this->deleteableFileFields['multiple']);

        $this->deleteableFileFieldsProcessSingle($single);
        $this->deleteableFileFieldsProcessMultiple($multiple);

        $this->validatedData = Arr::undot($this->validatedData);
    }

    private function deleteableFileFieldsProcessSingle(array $fields): void
    {
        foreach ($fields as $field) {
            $oldKeysField = "{$field}_old_keys";

            foreach ($this->validatedData as $key => $value) {
                if (!Str::is($oldKeysField, $key)) continue;

                $value = json_decode($value, true);

                if (!$value) {
                    $field = preg_replace('/_old_keys$/', '', $key);
                    $this->validatedData[$field] = $this->validatedData[$field] ?? null;
                }
            }
        }
    }

    private function deleteableFileFieldsProcessMultiple(array $fields): void
    {
        foreach ($fields as $field) {
            $oldKeysField = "{$field}_old_keys";

            foreach ($this->validatedData as $key => $value) {
                if (!Str::is($oldKeysField, $key)) continue;

                $field = preg_replace('/_old_keys$/', '', $key);

                $newFiles = array_filter(
                    $this->validatedData,
                    fn ($key) => Str::is("$field.*", $key),
                    ARRAY_FILTER_USE_KEY
                );

                $this->validatedData[$field] ??= [];
                $this->validatedData[$field]['old_keys'] = json_decode($value, true);
                $this->validatedData[$field]['new_files'] = $newFiles;
            }
        }
    }
}
