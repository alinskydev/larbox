<?php

namespace Tests\Feature\Tests\Admin\User\User;

use Tests\Feature\Traits\Index\PaginationTrait;
use Tests\Feature\Traits\Index\ShowDeletedTrait;

class IndexTest extends _TestCase
{
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => '1',
                'username' => 'admin',
                'email' => 'admin',
                'role' => 'admin',
                
                'profile.full_name' => 'admin',
                'profile.phone' => 'phone',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_sortings()
    {
        $this->requestQuery = [
            'sort' => [
                'id',
                'username',
                'email',
                'role',
                'user_profile.full_name',
                'user_profile.phone',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
