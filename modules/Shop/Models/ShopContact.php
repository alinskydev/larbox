<?php

namespace Modules\Shop\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class ShopContact extends Model
{
    use SoftDeletes;

    protected $table = 'shop_contact';
    
    protected $fillable = [
        'first_name',
        'second_name',
        'last_name',
        'position',
        'phone',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }
}
