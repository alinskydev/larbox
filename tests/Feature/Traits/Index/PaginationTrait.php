<?php

namespace Tests\Feature\Traits\Index;

trait PaginationTrait
{
    public function test_pagination()
    {
        $this->requestQuery = [
            'page-size' => '30',
            'page' => '1',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
