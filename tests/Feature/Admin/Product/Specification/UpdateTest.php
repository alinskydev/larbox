<?php

namespace Tests\Feature\Admin\Product\Specification;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'name' => [
                'ru' => 'Color ru',
                'uz' => 'Color uz',
            ],
            'options' => [
                [
                    'id' => '1',
                    'name' => [
                        'ru' => 'White ru',
                        'uz' => 'White uz',
                    ],
                ],
                [
                    'id' => '2',
                    'name' => [
                        'ru' => 'Black ru',
                        'uz' => 'Black uz',
                    ],
                ],
                [
                    'id' => '3',
                    'name' => [
                        'ru' => 'Red ru',
                        'uz' => 'Red uz',
                    ],
                ],
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
