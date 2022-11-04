<?php

namespace Http\Admin\Section\Tests;

class ContactTest extends _TestCase
{
    public function test_show()
    {
        $this->processShow('contact');
    }

    public function test_update()
    {
        $this->processUpdate(
            path: 'contact',
            body: [
                'socials_facebook' => '',
                'socials_instagram' => '',
                'socials_youtube' => '',

                'branches' => $this->formHelper::multiply(
                    range(1, 2),
                    fn ($index) => [
                        'name' => "Name $index",
                        'phones' => [
                            "+998 00 000 00 {$index}1",
                            "+998 00 000 00 {$index}2",
                        ],
                        'description' => $this->formHelper::localized("Description $index"),
                    ],
                ),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
