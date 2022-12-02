<?php

namespace Http\Website\Box\Tests\Brand;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->processUpdate(
            path: 'brand-2',
            body: [
                'name' => 'Brand 2',
                'show_on_the_home_page' => 1,
                'file' => $this->formHelper::file(),
                'files_list' => [
                    $this->formHelper::file(),
                    $this->formHelper::file(),
                ],
            ],
        );
    }

    public function test_error___Not_your_record(): void
    {
        $this->processUpdate(
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
