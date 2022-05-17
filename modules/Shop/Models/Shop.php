<?php

namespace Modules\Shop\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;
use Modules\Region\Models\RegionCity;
use Modules\Product\Models\ProductBrand;

class Shop extends Model
{
    use SoftDeletes;

    protected $table = 'shop';

    protected $fillable = [
        'agent_id',
        'city_id',
        'company_id',
        'name',
        'address',
        'has_credit_line',
        'location',
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(RegionCity::class, 'city_id')->withTrashed();
    }

    public function company()
    {
        return $this->belongsTo(ShopCompany::class, 'company_id')->withTrashed();
    }

    public function suppliers()
    {
        return $this->belongsToMany(
            ShopSupplier::class,
            'shop_supplier_ref',
            'shop_id',
            'supplier_id'
        )->withTrashed();
    }

    public function contacts()
    {
        return $this->belongsToMany(
            ShopSupplier::class,
            'shop_contact_ref',
            'shop_id',
            'contact_id'
        )->withTrashed();
    }

    public function brands()
    {
        return $this->belongsToMany(
            ProductBrand::class,
            'shop_brand_ref',
            'shop_id',
            'brand_id'
        )->withTrashed();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->agent_id = $model->agent_id ?: auth()->user()->id;
        });
    }
}
