<?php

namespace App\Services\Test\Feature;

use App\Services\Test\FeatureTestService;
use App\Search\Search;

class IndexFeatureTestService extends FeatureTestService
{
    public function availableRelations(int $assertStatus = 206)
    {
        $search = new $this->testCase->searchClass;

        $testCase = $this->testCase;
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $testCase->requestQuery = [
            'with' => $search->relations,
        ];

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }

    public function availableSortings(int $assertStatus = 206)
    {
        $search = new $this->testCase->searchClass;

        $testCase = $this->testCase;
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $sortings = array_keys($search->sortings);
        $sortings = array_map(fn ($value) => [$value, "-$value"], $sortings);
        $sortings = array_merge(...$sortings);

        $testCase->requestQuery = [
            'sort' => $sortings,
        ];

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }

    public function showWithDeleted(int $assertStatus = 206)
    {
        $testCase = $this->testCase;
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $testCase->requestQuery = [
            'show' => ['with-deleted'],
        ];

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }

    public function showOnlyDeleted(int $assertStatus = 206)
    {
        $testCase = $this->testCase;
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $testCase->requestQuery = [
            'show' => ['only-deleted'],
        ];

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }

    public function pagination(int $assertStatus = 206)
    {
        $search = new $this->testCase->searchClass;

        $testCase = $this->testCase;
        $testCase->requestMethod = $testCase::REQUEST_METHOD_GET;

        $testCase->requestQuery = [
            'page-size' => $search->pageSize,
            'page' => 1,
        ];

        $testCase->response = $testCase->sendRequest();
        $testCase->response->assertStatus($assertStatus);
    }
}
