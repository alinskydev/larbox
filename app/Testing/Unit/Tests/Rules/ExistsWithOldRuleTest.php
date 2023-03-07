<?php

namespace App\Testing\Unit\Tests\Rules;

use App\Rules\ExistsWithOldRule;
use App\Testing\Unit\TestCase;
use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;
use Modules\Box\Models\Tag;

class ExistsWithOldRuleTest extends TestCase
{
    // Single

    public function test_single_passed_new(): void
    {
        $rule = new ExistsWithOldRule(new Box(), Brand::query());
        $result = $rule->passes('brand_id', 1);

        $this->assertTrue($result);
    }

    public function test_single_passed_exists(): void
    {
        Brand::query()->where('id', 1)->delete();

        $rule = new ExistsWithOldRule(Box::query()->find(1), Brand::query());
        $result = $rule->passes('brand_id', 1);

        $this->assertTrue($result);

        Brand::query()->where('id', 1)->restore();
    }

    public function test_single_failed(): void
    {
        $rule = new ExistsWithOldRule(new Box(), Brand::query());
        $result = $rule->passes('brand_id', 11);

        $this->assertFalse($result);
    }

    // Multiple

    public function test_multiple_passed_new(): void
    {
        $rule = new ExistsWithOldRule(new Box(), Tag::query());
        $result = $rule->passes('tags', [1, 2]);

        $this->assertTrue($result);
    }

    public function test_multiple_passed_exists(): void
    {
        Tag::query()->where('id', 1)->delete();

        $rule = new ExistsWithOldRule(Box::query()->find(1), Tag::query());
        $result = $rule->passes('tags', [1, 2]);

        $this->assertTrue($result);

        Tag::query()->where('id', 1)->restore();
    }

    public function test_multiple_failed(): void
    {
        $rule = new ExistsWithOldRule(new Box(), Tag::query());
        $result = $rule->passes('tags', [1, 11]);

        $this->assertFalse($result);
    }
}
