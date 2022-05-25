<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Modules\Box\Models\Box;
use Modules\Box\Models\Brand;

use App\Observers\CreatorIdFieldObserver;
use App\Observers\Slug\SlugNameObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Box::class => [
            SlugNameObserver::class,
        ],
        Brand::class => [
            SlugNameObserver::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
