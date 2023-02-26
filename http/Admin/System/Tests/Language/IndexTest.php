<?php

namespace Http\Admin\System\Tests\Language;

use App\Testing\Feature\Traits\SearchFeatureTestTrait;
use Modules\System\Search\LanguageSearch;

class IndexTest extends _TestCase
{
    use SearchFeatureTestTrait {
        test_available_relations as private;
        test_show_with_deleted as private;
        test_show_only_deleted as private;
    }

    public string $searchClass = LanguageSearch::class;

    public function test_available_filters(): void
    {
        $this->sendRequestWithFilters([
            'id' => 1,
            'name' => 'русский',
            'code' => 'ru',
            'is_active' => 1,
            'is_main' => 1,
        ]);
    }
}
