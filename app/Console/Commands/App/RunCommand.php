<?php

namespace App\Console\Commands\App;

use Illuminate\Console\Command;
use Modules\Box\Models\Category;

class RunCommand extends Command
{
    protected $signature = 'app:run';

    protected $description = 'Run any script';

    public function handle(): void
    {
        $result = Category::query()->get()->toTree(1)->toArray();

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}
