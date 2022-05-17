<?php

namespace App\Tests\Feature\Traits\Delete;

use Tests\PostmanTestCase;

trait DeleteTrait
{
    public function test_delete()
    {
        $this->requestUrl .= '/2';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_DELETE;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
