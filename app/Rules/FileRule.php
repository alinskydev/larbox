<?php

namespace App\Rules;

use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make([$attribute => $value], [$attribute => [
            'file',
            "mimes:$this->mimes",
            "max:$this->max",
        ]]);

        $this->errorMessage = $validator->errors()->first($attribute);

        return !$validator->fails();
    }
}
