<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\AsImage;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'box_brand';
    
    protected $guarded = [
        'is_active',
    ];

    protected $casts = [
        'file' => AsImage::class . ':0,100|500',
        'files_list' => AsImage::class . ':1,100|500',
    ];
}
