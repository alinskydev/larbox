<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\Storage\AsImage;
use App\Casts\Storage\AsImages;

class Box extends Model
{
    use SoftDeletes;

    protected $table = 'box';

    protected $casts = [
        'name' => 'array',
        'date' => 'date:' . LARBOX_FORMAT_DATE,
        'datetime' => 'datetime',
        'image' => AsImage::class . ':100|500',
        'images_list' => AsImages::class . ':100|500',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id')->withTrashed();
    }

    public function variations()
    {
        return $this->hasMany(Variation::class, 'box_id')->orderBy('sort_index');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'box_tag_ref',
            'box_id',
            'tag_id'
        )->withTrashed();
    }
}