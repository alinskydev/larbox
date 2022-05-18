<?php

namespace Modules\User\Models;

use App\Models\UserModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends UserModel
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'user';
    
    protected $with = ['profile'];

    protected $guarded = [
        'email_verified_at',
        'remember_token',
        'reset_password_code',
    ];

    protected $hidden = [
        'email_verified_at',
        'password',
        'remember_token',
        'reset_password_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
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
