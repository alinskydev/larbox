<?php

namespace App\Tests\Feature\Traits;

use App\Tests\Feature\PostmanTestCase;

trait ShowFeatureTestTrait
{
    public function processShow(string $path = '1', int $assertStatus = 200)
    {
        $this->requestUrl .= $path ? "/$path" : '';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }
}
