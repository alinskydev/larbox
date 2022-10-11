<?php

namespace Http\Website\Box\Tests\Brand;

use App\Helpers\Test\Feature\FormHelper;

class CreateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => 'Brand 4',
            'show_on_the_home_page' => 1,
            'file' => FormHelper::file(),
            'files_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
