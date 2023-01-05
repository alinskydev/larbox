<?php

namespace Modules\Feedback\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Feedback\Observers\CallbackObserver;

class Callback extends Model
{
    use SoftDeletes;

    protected $table = 'feedback_callback';

    protected static function booted(): void
    {
        self::observe([
            CallbackObserver::class,
        ]);
    }
}
