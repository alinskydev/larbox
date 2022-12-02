<?php

namespace Modules\Seo\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Meta extends Model
{
    protected $table = 'seo_meta';

    public $timestamps = false;

    protected $visible = [
        'value',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public function seo_metable(): MorphTo
    {
        return $this->morphTo();
    }
}
