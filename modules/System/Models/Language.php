<?php

namespace Modules\System\Models;

use App\Base\Model;
use App\Casts\Storage\AsImage;
use Modules\System\Observers\LanguageObserver;

class Language extends Model
{
    protected $table = 'system_language';

    protected $casts = [
        'image' => AsImage::class . ':widen_25|widen_100|widen_500',
    ];

    protected static function booted(): void
    {
        self::observe([
            LanguageObserver::class,
        ]);
    }
}
