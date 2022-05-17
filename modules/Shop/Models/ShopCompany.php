<?php

namespace Modules\Shop\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopCompany extends Model
{
    use SoftDeletes;

    protected $table = 'shop_company';
    
    protected $fillable = [
        'name',
    ];
}
