<?php

namespace Tests\Feature\Admin\Common;

class DeleteThumbsTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_DELETE;

    public function test_success()
    {
        $this->requestUrl .= '/cache/delete-thumbs';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
