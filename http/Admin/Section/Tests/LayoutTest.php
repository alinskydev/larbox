<?php

namespace Http\Admin\Section\Tests;

class LayoutTest extends _TestCase
{
    public function test_show(): void
    {
        $this->processShow('layout');
    }

    public function test_update(): void
    {
        $this->processUpdate(
            path: 'layout',
            body: [
                'header_phone' => '+998 00 000 00 01',

                'footer_phone' => '+998 00 000 00 02',
                'footer_copyright' => $this->formHelper::localized('Copyright'),
            ],
        );
    }
}
