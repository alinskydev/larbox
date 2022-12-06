<?php

namespace Modules\Auth\Models;

use App\Base\Model;

class Code extends Model
{
    const UPDATED_AT = null;

    protected $table = 'auth_code';

    protected $primaryKey = 'key';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function (self $model) {
            if (!$model->attempts_left) $model->delete();
        });
    }
}
