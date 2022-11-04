<?php

namespace Http\Admin\System\Tests\Language;

class UpdateTest extends _TestCase
{
    public function test_success()
    {
        $this->processUpdate(
            body: [
                'name' => 'Русский',
                'image' => $this->formHelper::file(),
            ],
        );
    }
}
