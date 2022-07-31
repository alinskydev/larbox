<?php

namespace Http\Public\Box\Tests\Brand;

use App\Tests\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestUrl .= '/2';

        $this->requestBody = [
            'name' => 'Brand 2',
            'show_on_the_home_page' => 1,
            'file' => FormHelper::file(),
            'files_list' => [
                FormHelper::file(),
                FormHelper::file(),
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }

    public function test_error___Not_your_record()
    {
        $this->requestUrl .= '/1';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(404);
    }
}
