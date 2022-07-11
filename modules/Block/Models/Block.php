<?php

namespace Modules\Block\Models;

use App\Models\Model;
use Illuminate\Support\Arr;

class Block extends Model
{
    protected $table = 'block';

    public $incrementing = false;
    public $timestamps = false;

    protected $hidden = [
        'page_id',
        'options' => 'array',
    ];

    protected $guarded = [
        'page_id',
        'options' => 'array',
    ];

    protected $casts = [
        'options' => 'array',
        'value' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function (self $model) {
            if ($cast = Arr::get($model, 'options.cast')) {
                $model->mergeCasts([
                    'value' => $cast,
                ]);
            }
        });
    }
}
