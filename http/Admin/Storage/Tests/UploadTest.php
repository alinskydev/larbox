<?php

namespace Http\Admin\Storage\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class UploadTest extends _TestCase
{
    public function test_media(): void
    {
        $this->sendRequest(
            method: 'POST',
            path: 'upload/media',
            body: [
                'file' => FormHelper::files(),
            ],
        );
    }
}
