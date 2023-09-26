<?php

namespace Modules\System\Singletons;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\System\Models\Settings;

class SettingsSingleton
{
    public Collection $items;

    public function __construct()
    {
        $this->items = Cache::remember('app_settings', 86400, fn () => Settings::query()->get()->keyBy('name'));
    }

    public function __get($name)
    {
        return $this->items->get($name)->value;
    }
}
