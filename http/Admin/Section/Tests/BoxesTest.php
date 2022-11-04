<?php

namespace Http\Admin\Section\Tests;

class BoxesTest extends _TestCase
{
    public function test_show()
    {
        $this->processShow('boxes');
    }

    public function test_update()
    {
        $this->processUpdate(
            path: 'boxes',
            body: [
                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
