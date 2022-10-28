<?php

namespace Modules\System\Models;

use App\Base\Model;

class Settings extends Model
{
    protected $table = 'system_settings';

    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'name';
    protected $routeKeyName = 'name';
}
