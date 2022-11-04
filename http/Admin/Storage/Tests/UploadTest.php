<?php

namespace Http\Admin\Storage\Tests;

class UploadTest extends _TestCase
{
    public function test_file()
    {
        $this->processPost(
            path: 'upload/file',
            body: [
                'file' => $this->formHelper::file(),
            ],
        );
    }

    public function test_media()
    {
        $this->processPost(
            path: 'upload/media',
            body: [
                'file' => $this->formHelper::file(),
            ],
        );
    }
}
