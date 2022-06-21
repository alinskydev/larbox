<?php

namespace Modules\System\Services;

use Illuminate\Support\Collection;
use Modules\System\Models\Settings;

class SettingsService
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
