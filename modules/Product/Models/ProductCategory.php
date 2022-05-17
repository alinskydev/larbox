<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;

    protected $table = 'product_category';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function specifications()
    {
        return $this->belongsToMany(
            ProductSpecification::class,
            'product_category_specification_ref',
            'category_id',
            'specification_id'
        )->withTrashed();
    }
}
