<?php

namespace Modules\System\Services;

use Illuminate\Support\Arr;
use Modules\System\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public Collection $all;
    public Collection $active;
    public Language $main;

    public function __construct()
    {
        $this->all = Language::query()->get()->keyBy('code');
        $this->active = $this->all->filter(fn ($value) => $value->is_active);
        $this->main = Arr::keyBy($this->active, 'is_main')[1];

        // Setting locale

        $locale = request()->header('Accept-Language');

        if (isset($this->active[$locale])) {
            app()->setLocale($locale);
        } else {
            app()->setLocale($this->main->code);
        }
    }
}
