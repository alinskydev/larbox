<?php

namespace Modules\Seo\Models;

use App\Models\Model;

class Meta extends Model
{
    protected $table = 'seo_meta';

    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [
        'seo_metable_type',
        'seo_metable_id',
    ];

    protected $casts = [
        'head' => 'array',
    ];

    public function seo_metable()
    {
        return $this->morphTo();
    }
}
