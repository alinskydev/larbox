<?php

namespace Modules\User\Models;

use App\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Region\Models\Region;
use Modules\Region\Models\RegionCity;

class User extends UserModel
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'user';

    protected $fillable = [
        'username',
        'email',
        'password',

        'full_name',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'reset_password_key',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function regions()
    {
        return $this->belongsToMany(
            Region::class,
            'user_region_ref',
            'user_id',
            'region_id'
        )->withTrashed();
    }

    public function cities()
    {
        return $this->belongsToMany(
            RegionCity::class,
            'user_city_ref',
            'user_id',
            'city_id'
        )->withTrashed();
    }

    public function messages()
    {
        return $this->hasMany(UserMessage::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->id == 1) {
                abort(403, __('errors.user.undeleteable'));
            }
        });
    }
}
