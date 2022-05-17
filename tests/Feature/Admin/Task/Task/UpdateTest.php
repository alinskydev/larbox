<?php

namespace Tests\Feature\Admin\Task\Task;

use Illuminate\Http\UploadedFile;

class UpdateTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_PATCH;

    public function test_success()
    {
        $this->requestUrl .= '/1';

        $this->requestBody = [
            'agent_id' => '2',
            'type' => 'v',
            'name' => 'Task 1',
            'description' => 'Description 1',
            'execution_comment' => 'Execution comment 1',
            'deadline' => date('d.m.Y'),
            'reports' => [
                [
                    'id' => '1',
                    'shop_id' => '1',
                    'type' => 'ds',
                    'date_period_type' => 'week',
                ],
                [
                    'id' => '2',
                    'shop_id' => '1',
                    'type' => 'sr',
                    'date_period_type' => 'week',
                ],
                [
                    'id' => '2',
                    'shop_id' => '1',
                    'type' => 'ds',
                    'date_period_type' => 'month',
                ],
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
