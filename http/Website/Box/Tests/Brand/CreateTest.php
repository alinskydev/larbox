<?php

namespace Http\Website\Box\Tests\Brand;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processPost(
            body: [
                'name' => 'Brand 4',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::files(),
                'files_list' => $this->formHelper::files(quantity: 2),
            ],
            assertStatus: 201,
        );
    }
}
