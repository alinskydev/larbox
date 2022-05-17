<?php

namespace Tests\Feature\Common\Information;

use App\Tests\Feature\Config\AuthConfig;

class StatisticsTest extends _TestCase
{
    protected array $authHeaders = AuthConfig::PUBLIC_HEADERS;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_countings()
    {
        $this->requestUrl .= '/statistics/countings';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
