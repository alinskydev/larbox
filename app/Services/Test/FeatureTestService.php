<?php

namespace App\Services\Test;

use App\Tests\Feature\PostmanTestCase;

class FeatureTestService
{
    public function __construct(
        public PostmanTestCase $testCase,
    ) {
    }
}
