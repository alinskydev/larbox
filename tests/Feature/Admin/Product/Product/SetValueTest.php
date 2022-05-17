<?php

namespace Tests\Feature\Admin\Product\Product;

class SetValueTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_deactivate()
    {
        $this->requestUrl .= '/1/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_activate()
    {
        $this->requestUrl .= '/1/set-active/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }
}
