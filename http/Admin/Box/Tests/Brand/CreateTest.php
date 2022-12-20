<?php

namespace Http\Admin\Box\Tests\Brand;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPost(
            body: [
                'name' => 'Brand 3',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::files(),
                'file_old_keys' => '[]',
                'files_list' => $this->formHelper::files(quantity: 2),
                'files_list_old_keys' => '[]',

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
