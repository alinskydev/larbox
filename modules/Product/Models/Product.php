<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product';

    protected $fillable = [
        'category_id',
        'brand_id',
        'model_number',
        'sku',
        'date_eol',
        'images_list',
    ];

    protected $casts = [
        'date_eol' => 'date:d.m.Y',
        'images_list' => 'array',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id')->withTrashed();
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id')->withTrashed();
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class, 'product_id')->withTrashed();
    }
}
