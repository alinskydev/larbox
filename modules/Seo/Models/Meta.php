<?php

namespace Modules\Seo\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Seo\Observers\MetaObserver;

class Meta extends Model
{
    protected $table = 'seo_meta';

    public $timestamps = false;

    protected $visible = [
        'value',
        'value_as_array',
    ];

    protected $casts = [
        'value' => 'array',
        'value_as_array' => 'array',
    ];

    public function seo_metable(): MorphTo
    {
        return $this->morphTo();
    }

    protected static function booted(): void
    {
        self::observe([
            MetaObserver::class,
        ]);
    }
}
