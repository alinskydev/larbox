<?php

namespace Modules\User\Models;

use App\Base\Model;
use App\Casts\Storage\AsImage;

class Profile extends Model
{
    protected $table = 'user_profile';

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'user_id';
    protected $routeKeyName = 'user_id';

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'image' => AsImage::class . ':100|500',
    ];
}
