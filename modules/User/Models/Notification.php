<?php

namespace Modules\User\Models;

use App\Base\Model;
use App\Observers\CreatorObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected static function booted(): void
    {
        self::addGlobalScope(function ($query) {
            $query->filterByUser('owner_id');
        });

        self::observe([
            CreatorObserver::class,
        ]);
    }
}
