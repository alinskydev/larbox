<?php

namespace Http\Website\Box\Tests\Brand;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Box\Search\BrandSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_show_with_deleted as private;
        test_show_only_deleted as private;
    }

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
            'name' => 'brand',
            'show_on_the_home_page' => 1,
            'is_active' => 1,
        ]);
    }
}
