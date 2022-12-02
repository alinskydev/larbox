<?php

namespace App\Tests\Feature\Traits;

use App\Tests\Feature\PostmanTestCase;
use App\Base\Search;

trait IndexFeatureTestTrait
{
    protected Search $search;

    public function processAvailableRelations(int $assertStatus = 206): void
    {
        $this->search = new $this->searchClass();

        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'with' => $this->search->relations,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processAvailableFilters(array $params, int $assertStatus = 206): void
    {
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'filter' => $params,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processAvailableSortings(int $assertStatus = 206): void
    {
        $this->search = new $this->searchClass();

        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $sortings = array_keys($this->search->sortings);
        $sortings = array_map(fn ($value) => [$value, "-$value"], $sortings);
        $sortings = array_merge(...$sortings);

        $this->requestQuery = [
            'sort' => $sortings,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processAvailableShowings(array $params, int $assertStatus = 206): void
    {
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'show' => $params,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processShowWithDeleted(int $assertStatus = 206): void
    {
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'show' => ['with-deleted'],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processShowOnlyDeleted(int $assertStatus = 206): void
    {
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'show' => ['only-deleted'],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }

    public function processPagination(int $assertStatus = 206): void
    {
        $this->search = new $this->searchClass();

        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;

        $this->requestQuery = [
            'page-size' => $this->search->pageSize,
            'page' => 1,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }
}
