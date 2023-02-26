<?php

namespace Http\Admin\Section\Tests;

use App\Testing\Feature\Helpers\FormHelper;

class ContactTest extends _TestCase
{
    public function test_show(): void
    {
        $this->sendRequest(
            path: 'contact',
        );
    }

    public function test_update(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'contact',
            body: [
                'socials_facebook' => '',
                'socials_instagram' => '',
                'socials_youtube' => '',

                'branches' => array_map(
                    fn ($index) => [
                        'name' => "Name $index",
                        'phones' => [
                            "+998 00 000 00 {$index}1",
                            "+998 00 000 00 {$index}2",
                        ],
                        'description' => FormHelper::localized("Description $index"),
                    ],
                    range(1, 2),
                ),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
