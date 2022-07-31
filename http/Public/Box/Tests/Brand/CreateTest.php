<?php

namespace Http\Public\Box\Tests\Brand;

use App\Tests\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

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
