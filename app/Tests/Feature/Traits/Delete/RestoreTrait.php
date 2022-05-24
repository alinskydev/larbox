<?php

namespace App\Tests\Feature\Traits\Delete;

use App\Tests\Feature\PostmanTestCase;

trait RestoreTrait
{
    public function test_restore()
    {
        $this->requestUrl .= '/2/restore';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_DELETE;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
