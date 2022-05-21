<?php

namespace Modules\System\Models;

use App\Models\Model;

class Settings extends Model
{
    protected $table = 'system_settings';
    
    protected $primaryKey = 'name';
    public $incrementing = false;
    public $timestamps = false;
}
