<?php

namespace Modules\Shop\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;
use Modules\Region\Models\RegionCountry;

class ShopSupplier extends Model
{
    use SoftDeletes;

    protected $table = 'shop_supplier';
    
    protected $fillable = [
        'country_id',
        'short_name',
        'full_name',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function country()
    {
        return $this->belongsTo(RegionCountry::class, 'country_id')->withTrashed();
    }
}
