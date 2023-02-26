<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: '1',
            body: [
                'name' => 'Brand 1',
                'show_on_the_home_page' => 1,
                ...FormHelper::deleteableFiles(
                    field: 'file',
                    files: FormHelper::files(),
                    oldKeys: [0],
                ),
                ...FormHelper::deleteableFiles(
                    field: 'files_list',
                    files: FormHelper::files(quantity: 2),
                    oldKeys: [0, 1],
                ),

                ...FormHelper::seoMeta(),
            ],
        );
    }
}
