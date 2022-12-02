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
                'file' => $this->formHelper::file(),
                'files_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],
            ],
            assertStatus: 201,
        );
    }
}
