<?php

namespace Http\Admin\System\Tests\Settings;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            body: [
                'admin_email' => 'info@local.host',
                'delete_old_files' => 0,
                'favicon' => FormHelper::files(),
                'logo' => FormHelper::files(),
                'project_name' => 'Larbox',
            ],
        );
    }
}
