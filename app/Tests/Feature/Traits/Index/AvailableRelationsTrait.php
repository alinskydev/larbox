<?php

namespace App\Tests\Feature\Traits\Index;

trait AvailableRelationsTrait
{
    public function test_available_relations()
    {
        $search = new $this->searchClass();

        $this->requestQuery = [
            'with' => $search->relations,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
