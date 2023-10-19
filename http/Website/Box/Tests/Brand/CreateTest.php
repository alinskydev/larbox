<?php

namespace Http\Website\Box\Tests\Brand;

use App\Testing\Feature\Helpers\FormHelper;

class CreateTest extends _TestCase
{
    public function test_success(): void
    {
        $this->sendRequest(
            method: 'POST',
            body: [
                'name' => 'Brand 4',
                'show_on_the_home_page' => 1,
                'file' => FormHelper::files(),
                'files_list' => FormHelper::files(quantity: 2),
            ],
        );
    }
}
