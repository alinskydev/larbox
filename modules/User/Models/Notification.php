<?php

namespace Modules\User\Models;

use App\Models\Model;
use Modules\User\Scopes\UserScope;

class Notification extends Model
{
    const UPDATED_AT = null;

    protected $table = 'user_notification';

    protected $hidden = [
        'creator_id',
        'owner_id',
        'action_id',
        'params',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope(new UserScope('owner_id'));
    }
}
