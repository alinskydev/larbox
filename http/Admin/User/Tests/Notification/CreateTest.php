<?php

namespace Http\Admin\User\Tests\Notification;

use App\Testing\Feature\Helpers\FormHelper;
use Modules\User\Enums\NotificationTypeEnum;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'user_query' => '?filter[common]=Admin&filter[role_id]=1',
                'type' => NotificationTypeEnum::MESSAGE->value,
                'text' => 'Text 3',
            ],
        );
    }
}
