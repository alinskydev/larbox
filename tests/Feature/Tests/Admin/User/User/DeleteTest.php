<?php

namespace Tests\Feature\Tests\Admin\User\User;

use Tests\Feature\Traits\Delete\DeleteTrait;
use Tests\Feature\Traits\Delete\RestoreTrait;

class DeleteTest extends _TestCase
{
    use DeleteTrait;
    use RestoreTrait;

    protected string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_undeletable()
    {
        $this->requestUrl .= '/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(403);
    }
}
