<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Box\Search\BrandSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait;

    public string $searchClass = BrandSearch::class;

    public function test_available_showings(): void
    {
        $this->sendRequest(
            query: [
                'show' => ['boxes_count'],
            ],
        );
    }

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'creator_id' => 1,
            'name' => 'brand',
            'show_on_the_home_page' => 1,
            'is_active' => 1,
        ]);
    }
}
