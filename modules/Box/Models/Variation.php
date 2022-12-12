<?php

namespace Modules\Box\Models;

use App\Base\Model;

use App\Casts\Storage\AsImage;

class Variation extends Model
{
    protected $table = 'box_variation';

    public $timestamps = false;

    protected $hidden = [
        'box_id',
    ];

    protected $casts = [
        'name' => 'array',
        'image' => AsImage::class . ':widen_100|widen_500',
    ];
}
