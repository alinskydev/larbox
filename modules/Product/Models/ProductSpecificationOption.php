<?php

namespace Modules\Product\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ProductSpecificationOption extends Model
{
    protected $table = 'product_specification_option';

    protected $fillable = [
        'name',
        'sort_index',
    ];

    protected $casts = [
        'name' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $variation = DB::table('product_variation_option_ref')->where('option_id', $model->id)->first();

            if ($variation) {
                $locale = app()->getLocale();
                $name = Arr::get($model->name, $locale);

                abort(403, __('errors.product_specification_option.delete_used_by_variation', [
                    'option' => $name,
                    'variation' => $variation->variation_id,
                ]));
            }
        });
    }
}
