<?php

namespace Modules\User\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Scopes\UserScope;

class Notification extends Model
{
    const UPDATED_AT = null;

    protected $table = 'user_notification';

    protected $hidden = [
        'creator_id',
        'owner_id',
    ];

    protected $casts = [
        'params' => 'array',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }

    protected static function boot(): void
    {
        parent::boot();

        self::addGlobalScope(new UserScope('owner_id'));

        static::creating(function (self $model) {
            $model->creator_id ??= auth()->user()->id;
        });
    }
}
