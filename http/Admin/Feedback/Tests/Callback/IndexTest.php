<?php

namespace Http\Admin\Feedback\Tests\Callback;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\Feedback\Search\CallbackSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_relations as private;
    }

    public string $searchClass = CallbackSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'status' => 'unprocessed',
            'common' => 'full name',
        ]);
    }
}
