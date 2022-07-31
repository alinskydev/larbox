<?php

namespace App\Tests\Feature\Traits\Index;

trait PaginationTrait
{
    public function test_pagination()
    {
        $this->requestQuery = [
            'page-size' => 50,
            'page' => 1,
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
