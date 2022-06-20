<?php

namespace Modules\System\Models;

use App\Models\Model;
use App\Casts\Storage\AsImage;
use Illuminate\Support\Arr;

class Language extends Model
{
    protected $table = 'system_language';

    protected $guarded = [
        'code',
        'is_active',
        'is_main',
    ];

    protected $casts = [
        'image' => AsImage::class . ':30|100|500',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            if (Arr::get($model->original, 'is_active') && !$model->is_active) {
                if ($model->is_main) {
                    abort(403, __('model.system_language.deactivate_main'));
                }

                if ($model->code == app()->getLocale()) {
                    abort(403, __('model.system_language.deactivate_current'));
                }
            }

            if ($model->is_main) {
                $model->is_active = 1;

                $model->newQuery()->where('id', '!=', $model->id)->update(['is_main' => 0]);
            }
        });
    }
}
