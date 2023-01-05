<?php

namespace Http\Admin\Box\Tests\Category;

use Modules\Box\Models\Category;
use App\NestedSet\NestedSetHelper;

class MoveTest extends _TestCase
{
    public string $requestUrl = 'admin/box/category-move';
    public string $requestMethod = 'PATCH';

    public function test_success(): void
    {
        $model = Category::query()
            ->with(['children' => function ($query) {
                $query->select(['id', 'lft', 'rgt', 'depth']);
            }])
            ->select(['id', 'lft', 'rgt', 'depth'])
            ->findOrFail(1);

        $tree = NestedSetHelper::tree($model);
        $tree = json_encode($tree);
        $tree = htmlspecialchars($tree);

        $this->requestBody = [
            'tree' => $tree,

            'seo_meta' => $this->formHelper::seoMeta(),
        ];

        $this->response = $this->sendRequest();
        $this->response->assertStatus(200);
    }
}
