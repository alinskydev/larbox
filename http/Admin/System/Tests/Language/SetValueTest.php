<?php

namespace Http\Admin\System\Tests\Language;

class SetValueTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_deactivate()
    {
        $this->requestUrl .= '/2/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_activate()
    {
        $this->requestUrl .= '/2/set-active/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_deactivation_error___Main_language()
    {
        $this->requestUrl .= '/1/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(403);
    }

    public function test_set_main()
    {
        $this->requestUrl .= '/2/set-main/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_deactivation_error___Current_language()
    {
        $this->requestUrl .= '/2/set-active/0';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(403);
    }
}
