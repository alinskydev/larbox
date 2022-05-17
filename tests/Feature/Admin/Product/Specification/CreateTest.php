<?php

namespace Tests\Feature\Admin\Product\Specification;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'name' => [
                'ru' => 'Specification 3 ru',
                'uz' => 'Specification 3 uz',
            ],
            'options' => [
                [
                    'name' => [
                        'ru' => 'Option 1 ru',
                        'uz' => 'Option 1 uz',
                    ],
                ],
                [
                    'name' => [
                        'ru' => 'Option 2 ru',
                        'uz' => 'Option 2 uz',
                    ],
                ],
                [
                    'name' => [
                        'ru' => 'Option 3 ru',
                        'uz' => 'Option 3 uz',
                    ],
                ],
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
