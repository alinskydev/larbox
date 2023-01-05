<?php

namespace Http\Admin\User\Requests;

use App\Base\FormRequest;
use Modules\User\Enums\NotificationTypeEnum;

use Illuminate\Validation\Rule;

class NotificationRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'user_query' => 'present|nullable|string|max:1000',
            'type' => [
                'required',
                Rule::in([
                    NotificationTypeEnum::ANNOUNCEMENT->value,
                    NotificationTypeEnum::MESSAGE->value,
                ]),
            ],
            'text' => 'required|string',
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $user_query = html_entity_decode($this->validatedData['user_query']);
        $user_query = ltrim($user_query, '?');

        parse_str($user_query, $this->validatedData['user_query']);
    }
}
