<?php

namespace Http\Admin\Box\Tests\Category;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPost(
            body: [
                'name' => $this->formHelper::localized('Category 3'),

                'seo_meta' => $this->formHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
