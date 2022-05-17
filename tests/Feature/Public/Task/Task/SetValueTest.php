<?php

namespace Tests\Feature\Public\Task\Task;

class SetValueTest extends _TestCase
{
    protected string $requestMethod = self::REQUEST_METHOD_POST;

    public function test_start_task()
    {
        $this->requestUrl .= '/1/set-agent_status/in_progress';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_finish_task()
    {
        $this->requestUrl .= '/2/set-agent_status/completed';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(204);
    }

    public function test_finish_task_error___Reports_not_filled()
    {
        $this->requestUrl .= '/1/set-agent_status/completed';

        $this->response = $this->sendRequest();
        $this->response->assertStatus(403);
    }
}
