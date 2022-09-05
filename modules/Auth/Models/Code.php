<?php

namespace Modules\Auth\Models;

use App\Models\Model;

class Code extends Model
{
    const UPDATED_AT = null;

    protected $table = 'auth_code';

    public $incrementing = false;

    protected $primaryKey = 'key';
}
