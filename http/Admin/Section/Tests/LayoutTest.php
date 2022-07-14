<?php

namespace Http\Admin\Section\Tests;

use App\Tests\Feature\Helpers\FormHelper;

class LayoutTest extends _TestCase
{
    public function test_show()
    {
        $this->requestUrl .= '/layout';
        $this->requestMethod = self::REQUEST_METHOD_GET;

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_update()
    {
        $this->requestUrl .= '/layout';
        $this->requestMethod = self::REQUEST_METHOD_PATCH;

        $this->requestBody = [
            'header_phone' => '+998 (00) 111 11 11',
            'footer_phone' => '+998 (00) 222 22 22',
            'footer_description' => FormHelper::localized('Description'),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
