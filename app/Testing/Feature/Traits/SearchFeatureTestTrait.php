<?php

namespace App\Testing\Feature\Traits;

use App\Base\Search;

trait SearchFeatureTestTrait
{
    protected Search $search;

    public function test_available_sortings(): void
    {
        $this->search = new ($this->searchClass)();

        $sortings = array_keys($this->search->sortings);
        $sortings = array_map(fn ($value) => [$value, "-$value"], $sortings);
        $sortings = array_merge(...$sortings);

        $this->sendRequest(
            query: ['sort' => $sortings],
            assertStatus: 200,
        );
    }

    public function test_available_relations(): void
    {
        $this->search = new ($this->searchClass)();

        $this->sendRequest(
            query: ['with' => $this->search->relations],
            assertStatus: 200,
        );
    }

    public function test_show_with_deleted(): void
    {
        $this->sendRequest(
            query: ['show' => ['with-deleted']],
            assertStatus: 200,
        );
    }

    public function test_show_only_deleted(): void
    {
        $this->sendRequest(
            query: ['show' => ['only-deleted']],
            assertStatus: 200,
        );
    }

    public function test_pagination(): void
    {
        $this->search = new ($this->searchClass)();

        $this->sendRequest(
            query: [
                'page-size' => $this->search->pageSize,
                'page' => 1,
            ],
            assertStatus: 200,
        );
    }

    private function sendRequestWithFilters(array $params): void
    {
        $this->sendRequest(
            query: ['filter' => $params],
            assertStatus: 200,
        );
    }
}
