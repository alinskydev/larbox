<?php

namespace Modules\Box\Models;

use App\Models\Model;
use App\Casts\Storage\AsImage;
use App\Casts\Storage\AsImages;

class Variation extends Model
{
    protected $table = 'box_variation';

    public $timestamps = false;

    protected $guarded = [
        'box_id',
    ];

    protected $hidden = [
        'box_id',
    ];

    protected $casts = [
        'name' => 'array',
        'date' => 'date:' . LARBOX_FORMAT_DATE,
        'datetime' => 'datetime',
        'image' => AsImage::class . ':100|500',
        'images_list' => AsImages::class . ':100|500',
    ];
}
