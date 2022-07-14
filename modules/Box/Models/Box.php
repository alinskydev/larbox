<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;

use App\Casts\Date\AsDate;
use App\Casts\Date\AsDatetime;
use App\Casts\Storage\AsImage;
use App\Casts\Storage\AsImages;

class Box extends Model
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'date' => AsDate::class,
        'datetime' => AsDatetime::class,
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
