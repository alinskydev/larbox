<?php

namespace App\Observers\Slug;

use App\Observers\SlugObserver;

class SlugNameObserver extends SlugObserver
{
    protected string $sourceField = 'name';
}
