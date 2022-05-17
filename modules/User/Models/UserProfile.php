<?php

namespace Modules\User\Models;

use App\Models\Model;

class UserProfile extends Model
{
    protected $table = 'user_profile';
    
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];
}
