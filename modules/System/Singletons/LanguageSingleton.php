<?php

namespace Modules\System\Singletons;

use Illuminate\Support\Arr;
use Modules\System\Models\Language;

class LanguageSingleton
{
    public array $all;
    public array $active;
    public array $main;

    public function __construct()
    {
        $this->all = Language::query()->orderBy('id')->get()->keyBy('code')->toArray();
        $this->active = array_filter($this->all, fn ($value) => $value['is_active']);
        $this->main = Arr::keyBy($this->active, 'is_main')[1];

        $locale = request()->header('Accept-Language');
        $locale = isset($this->active[$locale]) ? $locale : $this->main['code'];

        app()->setLocale($locale);
    }
}
