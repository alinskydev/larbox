<?php

namespace Http\Admin\Box\Tests\Box;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Box\Search\BoxSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait;

    public string $searchClass = BoxSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'brand_id' => 1,
            'name' => 'box',
            'price' => [
                1000,
                10000,
            ],
            'date' => [
                date('Y-m-d', strtotime('-1 day')),
                date('Y-m-d'),
            ],
            'datetime' => date('Y-m-d H:i:s'),

            'categories.id' => 3,
            'tags.id' => [1, 2],
        ]);
    }
}
