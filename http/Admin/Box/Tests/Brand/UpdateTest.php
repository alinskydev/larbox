<?php

namespace Http\Admin\Box\Tests\Brand;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            body: [
                'name' => 'Brand 1',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::files(),
                'file_old_keys' => '[0]',
                'files_list' => $this->formHelper::files(quantity: 2),
                'files_list_old_keys' => '[0, 1]',

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
