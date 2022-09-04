<?php

namespace Http\Admin\System\Tests\Language;

use App\Helpers\Test\Feature\FormHelper;

class UpdateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => 'Русский',
            'image' => FormHelper::file(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
