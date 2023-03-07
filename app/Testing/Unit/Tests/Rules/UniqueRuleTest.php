<?php

namespace App\Testing\Unit\Tests\Rules;

use App\Rules\UniqueRule;
use App\Testing\Unit\TestCase;
use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;

class UniqueRuleTest extends TestCase
{
    // Non localized

    public function test_non_localized_passed(): void
    {
        $rule = new UniqueRule(new Brand(), false);
        $result = $rule->passes('name', 'Brand 11');

        $this->assertTrue($result);
    }

    public function test_non_localized_failed(): void
    {
        $rule = new UniqueRule(new Brand(), false);
        $result = $rule->passes('name', 'Brand 1');

        $this->assertFalse($result);
    }

    // Localized

    public function test_localized_passed(): void
    {
        $rule = new UniqueRule(new Box(), true);
        $result = $rule->passes('name.ru', 'Box 11 ru');

        $this->assertTrue($result);
    }

    public function test_localized_failed(): void
    {
        $rule = new UniqueRule(new Box(), true);
        $result = $rule->passes('name.ru', 'Box 1 ru');

        $this->assertFalse($result);
    }
}
