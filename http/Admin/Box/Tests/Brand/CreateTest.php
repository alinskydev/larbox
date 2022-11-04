<?php

namespace Http\Admin\Box\Tests\Brand;

class CreateTest extends _TestCase
{
    public function test_success()
    {
        $this->processPost(
            body: [
                'name' => 'Brand 3',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::file(),
                'files_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
