<?php

namespace Http\Admin\User\Requests;

use App\Base\FormRequest;
use Modules\User\Jobs\NotificationPrepareCreateJob;

use Illuminate\Validation\Rule;

class NotificationRequest extends FormRequest
{
    public function nonLocalizedRules(): array
    {
        return [
            'user_query' => 'present|nullable|string|max:1000',
            'type' => [
                'required',
                Rule::in(['message', 'announcement']),
            ],
            'text' => 'required|string',
        ];
    }

    protected function passedValidation(): void
    {
        parent::passedValidation();

        $data = $this->validated();

        $user_query = html_entity_decode($data['user_query']);
        $user_query = ltrim($user_query, '?');

        parse_str($user_query, $data['user_query']);

        NotificationPrepareCreateJob::dispatch(
            data: $data,
            creatorId: auth()->user()->id,
        );
    }
}
