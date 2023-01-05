<?php

namespace Http\Admin\Storage\Tests;

class UploadTest extends _TestCase
{
    public function test_media(): void
    {
        $this->processPost(
            path: 'upload/media',
            body: [
                'file' => $this->formHelper::files(),
            ],
        );
    }
}
