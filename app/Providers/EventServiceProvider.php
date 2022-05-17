<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Observers\CreatorIdFieldObserver;
use App\Observers\IsActiveFieldObserver;

use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Report\Models\Report;
use Modules\Shop\Models\Shop;
use Modules\Shop\Models\ShopContact;
use Modules\Shop\Models\ShopSupplier;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Product::class => [
            CreatorIdFieldObserver::class,
            IsActiveFieldObserver::class,
        ],
        ProductBrand::class => [
            CreatorIdFieldObserver::class,
            IsActiveFieldObserver::class,
        ],
        Report::class => [
            CreatorIdFieldObserver::class,
        ],
        Shop::class => [
            IsActiveFieldObserver::class,
        ],
        ShopContact::class => [
            CreatorIdFieldObserver::class,
            IsActiveFieldObserver::class,
        ],
        ShopSupplier::class => [
            CreatorIdFieldObserver::class,
            IsActiveFieldObserver::class,
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
