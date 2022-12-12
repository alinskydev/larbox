<?php

namespace App\Tests\Feature;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplicationTrait
{
    public function createApplication(): Application
    {
        $app = require __DIR__ . '../../../../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
