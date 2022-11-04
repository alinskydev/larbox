<?php

namespace App\Tests\Feature\Traits;

use App\Tests\Feature\PostmanTestCase;

trait DeleteFeatureTestTrait
{
    public function processDelete(string $path = '2', int $assertStatus = 200)
    {
        $this->requestUrl .= $path ? "/$path" : '';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_DELETE;

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processRestore(string $path = '2/restore', int $assertStatus = 200)
    {
        $this->requestUrl .= $path ? "/$path" : '';
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_DELETE;

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }
}
