<?php

namespace Modules\Region\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegionCity extends Model
{
    use SoftDeletes;

    protected $table = 'region_city';
    
    protected $fillable = [
        'region_id',
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id')->withTrashed();
    }
}
