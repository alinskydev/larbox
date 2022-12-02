<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;

use App\Observers\Slug\SlugNameObserver;
use App\Observers\ActivateObserver;
use App\Observers\CreatorObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Box::class => [
            SlugNameObserver::class,
        ],
        Brand::class => [
            SlugNameObserver::class,
            ActivateObserver::class,
            CreatorObserver::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
