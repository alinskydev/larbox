<?php

namespace Modules\System\Observers;

use Modules\System\Models\Language;

class LanguageObserver
{
    public function saving(Language $model): void
    {
        if ($model->getOriginal('is_active') && !$model->is_active) {
            if ($model->is_main) {
                throw new \Exception(__('Невозможно деактивировать основной язык'));
            }

            if ($model->code == app()->getLocale()) {
                throw new \Exception(__('Невозможно деактивировать текущий язык'));
            }
        }

        if ($model->is_main) {
            $model->is_active = 1;
            $model->newQuery()->where('id', '!=', $model->id)->update(['is_main' => 0]);
        }
    }
}
