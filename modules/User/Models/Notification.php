<?php

namespace Modules\User\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Scopes\UserScope;

class Notification extends Model
{
    public const TYPE_ANNOUNCEMENT = 'announcement';
    public const TYPE_FEEDBACK_CALLBACK_CREATED = 'feedback_callback_created';
    public const TYPE_MESSAGE = 'message';

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
    }
}
