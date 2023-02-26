<?php

namespace Http\Website\Box\Tests\Brand;

use App\Testing\Feature\Helpers\FormHelper;

class UpdateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'brand-2',
            body: [
                'name' => 'Brand 2',
                'show_on_the_home_page' => 1,
                'file' => FormHelper::files(),
                'files_list' => FormHelper::files(quantity: 2),
            ],
        );
    }

    public function test_error___Another_user_record(): void
    {
        $this->sendRequest(
            method: 'PUT',
            path: 'brand-1',
            assertStatus: 404,
        );
    }
}
