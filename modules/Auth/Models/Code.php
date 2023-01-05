<?php

namespace Modules\Auth\Models;

use App\Base\Model;
use Modules\Auth\Observers\CodeObserver;

class Code extends Model
{
    const UPDATED_AT = null;

    protected $table = 'auth_code';

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function booted(): void
    {
        self::observe([
            CodeObserver::class,
        ]);
    }
}
