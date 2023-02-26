<?php

namespace Http\Admin\Box\Tests\Tag;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Box\Search\TagSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_relations as private;
    }

    public string $searchClass = TagSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'name' => 'tag',
        ]);
    }
}
