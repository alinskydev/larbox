<?php

namespace App\Testing\Feature\Traits;

use App\Testing\Feature\PostmanTestCase;
use App\Base\Search;

trait IndexFeatureTestTrait
{
    protected Search $search;

    public function processAvailableRelations(int $assertStatus = 206): void
    {
        $this->search = new ($this->searchClass)();

        $this->processIndexRequest(
            requestQuery: ['with' => $this->search->relations],
            assertStatus: $assertStatus,
        );
    }

    public function processAvailableFilters(array $params, int $assertStatus = 206): void
    {
        $this->processIndexRequest(
            requestQuery: ['filter' => $params],
            assertStatus: $assertStatus,
        );
    }

    public function processAvailableSortings(int $assertStatus = 206): void
    {
        $this->search = new ($this->searchClass)();

        $sortings = array_keys($this->search->sortings);
        $sortings = array_map(fn ($value) => [$value, "-$value"], $sortings);
        $sortings = array_merge(...$sortings);

        $this->processIndexRequest(
            requestQuery: ['sort' => $sortings],
            assertStatus: $assertStatus,
        );
    }

    public function processShowWithDeleted(int $assertStatus = 206): void
    {
        $this->processIndexRequest(
            requestQuery: ['show' => ['with-deleted']],
            assertStatus: $assertStatus,
        );
    }

    public function processShowOnlyDeleted(int $assertStatus = 206): void
    {
        $this->processIndexRequest(
            requestQuery: ['show' => ['only-deleted']],
            assertStatus: $assertStatus,
        );
    }

    public function processPagination(int $assertStatus = 206): void
    {
        $this->search = new ($this->searchClass)();

        $this->processIndexRequest(
            requestQuery: [
                'page-size' => $this->search->pageSize,
                'page' => 1,
            ],
            assertStatus: $assertStatus,
        );
    }

    public function processIndexRequest(array $requestQuery, int $assertStatus = 206): void
    {
        $this->requestMethod = PostmanTestCase::REQUEST_METHOD_GET;
        $this->requestQuery = $requestQuery;

        $this->response = $this->sendRequest();
        $this->response->assertStatus($assertStatus);
    }
}
