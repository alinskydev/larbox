<?php

namespace Modules\System\Models;

use App\Base\Model;
use App\Casts\Storage\AsImage;
use Illuminate\Support\Arr;

class Language extends Model
{
    protected $table = 'system_language';

    protected $casts = [
        'image' => AsImage::class . ':30|100|500',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            if (Arr::get($model->original, 'is_active') && !$model->is_active) {
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
        });
    }
}
