<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => 'Tag 3',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
