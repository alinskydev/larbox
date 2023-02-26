<?php

namespace Http\Admin\Section\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class LayoutTest extends _TestCase
{
    public function test_show(): void
    {
        $this->sendRequest(
            path: 'layout',
        );
    }

    public function test_update(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'layout',
            body: [
                'header_phone' => '+998 00 000 00 01',

                'footer_phone' => '+998 00 000 00 02',
                'footer_copyright' => FormHelper::localized('Copyright'),
            ],
        );
    }
}
