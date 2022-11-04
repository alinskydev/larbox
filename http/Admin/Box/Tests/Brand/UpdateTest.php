<?php

namespace Http\Admin\Box\Tests\Brand;

class UpdateTest extends _TestCase
{
    public function test_success()
    {
        $this->processUpdate(
            body: [
                'name' => 'Brand 1',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::file(),
                'files_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
