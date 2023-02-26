<?php

namespace Http\Admin\User\Tests\User;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\User\Search\UserSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_relations as private;
    }

    public string $searchClass = UserSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'common' => 'admin',
            'id' => 1,
            'role_id' => 1,
        ]);
    }
}
