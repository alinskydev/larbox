<?php

namespace Modules\System\Models;

use App\Base\Model;

class Settings extends Model
{
    protected $table = 'system_settings';
    
    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;
}
