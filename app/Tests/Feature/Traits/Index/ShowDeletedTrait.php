<?php

namespace App\Tests\Feature\Traits\Index;

trait ShowDeletedTrait
{
    public function test_show_with_deleted()
    {
        $this->requestQuery = [
            'show' => [
                'with-deleted',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_show_only_deleted()
    {
        $this->requestQuery = [
            'show' => [
                'only-deleted',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
