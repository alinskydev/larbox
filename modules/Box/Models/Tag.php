<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'box_tag';

    protected $hidden = ['pivot'];
}
