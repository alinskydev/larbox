<?php

namespace Http\Admin\System\Tests\Language;

use App\Tests\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PUT;

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
