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

    protected function deleteableFileFieldsSingleValidation(
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

    protected function deleteableFileFieldsMultipleValidation(
        string $field,
        array $config,
        bool $isRequired = false,
    ): array {
        $this->deleteableFileFields['multiple'][] = $field;

        return [
            $field => [
                'array',
                $isRequired ? 'required' : null,
            ],
            "$field.*" => ValidationFileHelper::rules($config, $isRequired),
            "{$field}_old_keys" => 'required|json',
        ];
    }

    protected function deleteableFileFieldsProcess(): void
    {
        $this->validatedData = Arr::dot($this->validatedData);

        $this->deleteableFileFieldsProcessSingle();
        $this->deleteableFileFieldsProcessMultiple();

        $this->validatedData = Arr::undot($this->validatedData);
    }

    private function deleteableFileFieldsProcessSingle(): void
    {
        $fields = array_unique($this->deleteableFileFields['single']);

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

    private function deleteableFileFieldsProcessMultiple(): void
    {
        $fields = array_unique($this->deleteableFileFields['multiple']);

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
