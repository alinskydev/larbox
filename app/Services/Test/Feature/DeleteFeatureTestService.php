<?php

namespace App\Services\Test\Feature;

use App\Services\Test\FeatureTestService;

class DeleteFeatureTestService extends FeatureTestService
{
    public function delete(string $path = '2', int $assertStatus = 200)
    {
        $testCase = $this->testCase;

        $testCase->requestUrl .= "/$path";
        $testCase->requestMethod = $testCase::REQUEST_METHOD_DELETE;

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }

    public function restore(string $path = '2/restore', int $assertStatus = 200)
    {
        $testCase = $this->testCase;

        $testCase->requestUrl .= "/$path";
        $testCase->requestMethod = $testCase::REQUEST_METHOD_DELETE;

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }
}
