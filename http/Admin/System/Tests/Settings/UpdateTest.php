<?php

namespace Http\Admin\System\Tests\Settings;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            path: '',
            body: [
                'admin_email' => 'info@local.host',
                'delete_old_files' => 0,
                'favicon' => $this->formHelper::files(),
                'logo' => $this->formHelper::files(),
                'project_name' => 'Larbox',
            ],
        );
    }
}
