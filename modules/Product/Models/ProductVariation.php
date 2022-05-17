<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use SoftDeletes;

    protected $table = 'product_variation';

    protected $fillable = [
        'product_id',
        'sku',
        'images_list',
    ];

    protected $casts = [
        'images_list' => 'array',
    ];

    public function options()
    {
        return $this->belongsToMany(
            ProductSpecificationOption::class,
            'product_variation_option_ref',
            'variation_id',
            'option_id'
        );
    }
}
