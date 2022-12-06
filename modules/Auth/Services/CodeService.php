<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use Modules\Auth\Mail\CodeMail;
use Modules\Auth\Models\Code;

class CodeService
{
    private Code $model;

    public function __construct(
        public string $key,
    ) {
        $this->model = Code::query()->findOrNew($this->key);
        $this->model->key = $this->key;
    }

    public function sendCode(): void
    {
        // $code = Str::random(32);
        $code = 1234;

        $this->model->code = $code;
        $this->model->attempts_left = 3;
        $this->model->save();

        Mail::to($this->key)->send(new CodeMail($code));
    }

    public function checkCode(string $code): array
    {
        if (!$this->model->exists) {
            return [
                'is_correct' => false,
                'error' => __('Код не найден, попробуйте отправить его заново'),
            ];
        }

        $isCorrect = $this->model->code == $code;

        if (!$isCorrect) {
            $this->model->attempts_left--;
            $this->model->save();
        }

        return [
            'is_correct' => $isCorrect,
            'error' => __('Неправильный код, осталось попыток: :attempts_left', [
                'attempts_left' => $this->model->attempts_left,
            ]),
        ];
    }

    public function delete(): void
    {
        $this->model->delete();
    }
}
