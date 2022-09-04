<?php

namespace App\Services\Test\Feature;

use App\Services\Test\FeatureTestService;

class ShowFeatureTestService extends FeatureTestService
{
    public function show(string $path = '1', int $assertStatus = 200)
    {
        $testCase = $this->testCase;

        $testCase->requestUrl .= "/$path";
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }
}
