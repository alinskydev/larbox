<?php

namespace App\Services;

use App\Traits\SingletonTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\System\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LocalizationService
{
    use SingletonTrait;

    public Collection $allLanguages;
    public Collection $activeLanguages;

    public static function getInstance(): self
    {
        if (!self::$instance) {
            $instance = new self();
            $instance->allLanguages = Language::query()->get()->keyBy('code');
            $instance->activeLanguages = $instance->allLanguages->filter(fn ($value) => $value->is_active);

            self::$instance = $instance;
        }

        return self::$instance;
    }

    public function setLocaleAndGetRouteParameter()
    {
        $locale = request()->header('Accept-Language');

        if (isset($this->activeLanguages[$locale])) {
            app()->setLocale($locale);
        } else {
            $mainLanguage = Arr::pluck($this->activeLanguages, 'code', 'is_main');
            app()->setLocale($mainLanguage[1]);
        }
    }
}
