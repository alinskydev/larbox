<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class ProductBrand extends Model
{
    use SoftDeletes;

    protected $table = 'product_brand';

    protected $fillable = [
        'name',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }
}
