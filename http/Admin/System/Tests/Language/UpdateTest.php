<?php

namespace Http\Admin\System\Tests\Language;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '1',
            body: [
                'name' => 'Русский',
                'image' => FormHelper::files(),
            ],
        );
    }
}
