<?php

namespace Http\Admin\Box\Tests\Category;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Box\Search\CategorySearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_sortings as private;
        test_available_relations as private;
    }

    public string $searchClass = CategorySearch::class;

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
            'id' => 3,
            'depth' => 1,
            'name' => 'category',
        ]);
    }
}
