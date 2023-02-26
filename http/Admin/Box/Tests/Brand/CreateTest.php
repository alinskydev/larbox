<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'name' => 'Brand 3',
                'show_on_the_home_page' => 1,
                ...FormHelper::deleteableFiles(
                    field: 'file',
                    files: FormHelper::files(),
                    oldKeys: [],
                ),
                ...FormHelper::deleteableFiles(
                    field: 'files_list',
                    files: FormHelper::files(quantity: 2),
                    oldKeys: [],
                ),

                ...FormHelper::seoMeta(),
            ],
            assertStatus: 201,
        );
    }
}
