<?php

namespace App\Rules;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class FileRule extends Rule
{
    public function __construct(
        public string $mimes,
        public ?int $max = null
    ) {
        $this->max = $this->max ?? config('larbox.form_request.file.max.default');
    }

    public function passes($attribute, $value)
    {
        $data = Arr::undot([$attribute => $value]);

        $validator = Validator::make($data, [$attribute => [
            'file',
            "mimes:$this->mimes",
            "max:$this->max",
        ]]);

        $this->errorMessage = $validator->errors()->all();

        return !$validator->fails();
    }
}
