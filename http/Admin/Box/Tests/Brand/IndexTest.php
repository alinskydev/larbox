<?php

namespace Http\Admin\Box\Tests\Brand;

use App\Tests\Feature\Traits\Index\AvailableSortingsTrait;
use App\Tests\Feature\Traits\Index\AvailableRelationsTrait;
use App\Tests\Feature\Traits\Index\PaginationTrait;
use App\Tests\Feature\Traits\Index\ShowDeletedTrait;

use Modules\Box\Search\BrandSearch;

class IndexTest extends _TestCase
{
    use AvailableSortingsTrait;
    use AvailableRelationsTrait;
    use PaginationTrait;
    use ShowDeletedTrait;

    protected string $searchClass = BrandSearch::class;

    protected string $requestMethod = self::REQUEST_METHOD_GET;

    public function test_available_filters()
    {
        $this->requestQuery = [
            'filter' => [
                'id' => 1,
                'creator_id' => 1,
                'name' => 'brand',
                'slug' => 'brand-1',
                'show_on_the_home_page' => 1,
                'is_active' => 1,
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }

    public function test_available_showings()
    {
        $this->requestQuery = [
            'show' => [
                'boxes_count',
            ],
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(206);
    }
}
