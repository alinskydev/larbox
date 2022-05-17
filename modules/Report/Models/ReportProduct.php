<?php

namespace Modules\Report\Models;

use App\Models\Model;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductVariation;
use Modules\Shop\Models\ShopSupplier;

class ReportProduct extends Model
{
    protected $table = 'report_product';

    protected $fillable = [
        'product_id',
        'variation_id',
        'supplier_id',
        'quantity',
        'sort_index',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id')->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo(ShopSupplier::class, 'supplier_id')->withTrashed();
    }
}
