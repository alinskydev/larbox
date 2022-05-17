<?php

namespace Modules\User\Models;

use App\Models\Model;

class UserMessage extends Model
{
    const UPDATED_AT = null;

    protected $table = 'user_message';

    protected $fillable = [
        'user_id',
        'text',
        'files_list',
    ];

    protected $casts = [
        'files_list' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($model) {
            $user = auth()->user();

            if (!$model->is_seen) {
                $condition_1 = $user->role == 'admin' && !$model->is_sent_by_admin;
                $condition_2 = $user->role != 'admin' && $model->user_id == $user->id && $model->is_sent_by_admin;

                if ($condition_1 || $condition_2) {
                    $model->is_seen = true;
                    $model->saveQuietly();
                }
            }
        });

        static::creating(function ($model) {
            $model->user_id = $model->user_id ?: auth()->user()->id;
            $model->is_sent_by_admin = auth()->user()->role == 'admin';
        });
    }
}
