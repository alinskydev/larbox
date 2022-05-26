<?php

namespace Http\Public\Box\Tests\Brand;

use App\Tests\Feature\Traits\ShowTrait;

class ShowTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_error___Not_your_record()
    {
        $this->requestUrl .= '/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(404);
    }
}
