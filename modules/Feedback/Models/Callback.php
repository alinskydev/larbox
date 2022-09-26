<?php

namespace Modules\Feedback\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Callback extends Model
{
    use SoftDeletes;

    protected $table = 'feedback_callback';
}
