<?php

namespace Modules\Seo\Models;

use App\Models\Model;

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

    public function seo_metable()
    {
        return $this->morphTo();
    }
}
