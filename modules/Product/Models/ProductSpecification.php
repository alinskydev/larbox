<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSpecification extends Model
{
    use SoftDeletes;

    protected $table = 'product_specification';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    public function options()
    {
        return $this->hasMany(ProductSpecificationOption::class, 'specification_id')->orderBy('sort_index');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if ($model->id == 1) {
                abort(403, __('errors.product_specification.undeleteable'));
            }
        });
    }
}
