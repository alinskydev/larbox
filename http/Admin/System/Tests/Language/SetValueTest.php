<?php

namespace Http\Admin\System\Tests\Language;

class SetValueTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_set_main()
    {
        $this->requestUrl .= '/1/set-main/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_activate()
    {
        $this->requestUrl .= '/2/set-active/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_deactivate()
    {
        $this->requestUrl .= '/2/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_deactivation_error___Main_or_current_language()
    {
        $this->requestUrl .= '/1/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(400);
    }
}
