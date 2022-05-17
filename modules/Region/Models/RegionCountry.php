<?php

namespace Modules\Region\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegionCountry extends Model
{
    use SoftDeletes;

    protected $table = 'region_country';
    
    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];
}
