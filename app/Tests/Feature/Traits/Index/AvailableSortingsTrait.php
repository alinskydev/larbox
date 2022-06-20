<?php

namespace App\Tests\Feature\Traits\Index;

trait AvailableSortingsTrait
{
    public function test_available_sortings()
    {
        $search = new $this->searchClass();

        $this->requestQuery = [
            'sort' => array_keys($search->relations),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
