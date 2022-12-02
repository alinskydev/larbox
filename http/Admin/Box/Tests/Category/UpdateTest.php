<?php

namespace Http\Admin\Box\Tests\Category;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            path: '2',
            body: [
                'name' => $this->formHelper::localized('Category 1'),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
        );
    }
}
