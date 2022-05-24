<?php

namespace App\Tests\Feature\Traits;

use App\Tests\Feature\PostmanTestCase;

trait ShowTrait
{
    public function test_success()
    {
        $this->requestUrl .= '/1';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;
        
        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);

    }
}
