<?php

namespace Modules\Region\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;

    protected $table = 'region';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];
}
