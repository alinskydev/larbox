<?php

namespace Http\Admin\Storage\Tests;

class UploadTest extends _TestCase
{
    public function test_file(): void
    {
        $this->processPost(
            path: 'upload/file',
            body: [
                'file' => $this->formHelper::file(),
            ],
        );
    }

    public function test_media(): void
    {
        $this->processPost(
            path: 'upload/media',
            body: [
                'file' => $this->formHelper::file(),
            ],
        );
    }
}
