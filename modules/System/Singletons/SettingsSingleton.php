<?php

namespace Modules\System\Singletons;

use Illuminate\Support\Collection;
use Modules\System\Models\Settings;

class SettingsSingleton
{
    public Collection $items;

    public function __construct()
    {
        $this->items = Settings::query()->get()->keyBy('name');
    }

    public function __get($name)
    {
        return $this->items->get($name)->value;
    }
}
