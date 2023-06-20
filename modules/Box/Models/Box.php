<?php

namespace Modules\Box\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Box\QueryBuilders\BoxQueryBuilder;
use App\Observers\Slug\SlugNameObserver;
use App\Casts\Storage\AsImage;
use App\Casts\Storage\AsImages;

/**
 * @method static BoxQueryBuilder query()
 */
class Box extends Model
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'image' => AsImage::class . ':widen_100|widen_500',
        'images_list' => AsImages::class . ':widen_100|widen_500',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id')->withTrashed();
    }

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class, 'box_id')->orderBy('sort_index');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'box_category_ref', 'box_id', 'category_id')->withTrashed();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'box_tag_ref', 'box_id', 'tag_id')->withTrashed();
    }

    public function newEloquentBuilder($query): BoxQueryBuilder
    {
        return new BoxQueryBuilder($query);
    }

    protected static function booted(): void
    {
        self::observe([
            SlugNameObserver::class,
        ]);
    }
}
