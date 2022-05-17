<?php

namespace Tests\Feature\Admin\Task\Task;

use Illuminate\Http\UploadedFile;

class CreateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_success()
    {
        $this->requestBody = [
            'agent_id' => '2',
            'type' => 'v',
            'name' => 'Task 3',
            'description' => 'Description 3',
            'execution_comment' => 'Execution comment 3',
            'deadline' => date('d.m.Y'),
            'reports' => [
                [
                    'shop_id' => '1',
                    'type' => 'ds',
                    'date_period_type' => 'week',
                ],
                [
                    'shop_id' => '1',
                    'type' => 'sr',
                    'date_period_type' => 'week',
                ],
                [
                    'shop_id' => '1',
                    'type' => 'ds',
                    'date_period_type' => 'month',
                ],
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(201);
    }
}
