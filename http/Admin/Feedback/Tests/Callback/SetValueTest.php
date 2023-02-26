<?php

namespace Http\Admin\Feedback\Tests\Callback;

use Modules\Feedback\Enums\FeedbackStatusEnum;

class SetValueTest extends _TestCase
{
    public function test_change_status(): void
    {
        $status = FeedbackStatusEnum::IN_PROGRESS->value;

        $this->sendRequest(
            method: 'PATCH',
            path: "1/set-status/$status",
        );
    }
}
