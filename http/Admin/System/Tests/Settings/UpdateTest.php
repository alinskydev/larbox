<?php

namespace Http\Admin\System\Tests\Settings;

use App\Helpers\Test\Feature\FormHelper;

class UpdateTest extends _TestCase
{
    public string $requestMethod = self::REQUEST_METHOD_PUT;

    public function test_success()
    {
        $this->requestBody = [
            'admin_email' => 'info@local.host',
            'delete_old_files' => 0,
            'favicon' => FormHelper::file(),
            'logo' => FormHelper::file(),
            'project_name' => 'Larbox',
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
