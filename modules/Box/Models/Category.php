<?php

namespace Modules\Box\Models;

use App\Base\Model;
use App\NestedSet\NestedSetModelTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Modules\Box\Observers\CategoryObserver;
use Modules\Seo\Traits\SeoMetaModelTrait;

class Category extends Model
{
    use SoftDeletes;
    use SeoMetaModelTrait;
    use NestedSetModelTrait;

    protected $table = 'box_category';

    protected $casts = [
        'name' => 'array',
    ];

    public function getTextAttribute(): ?string
    {
        return Arr::get($this->name, app()->getLocale());
    }

    public function boxes(): BelongsToMany
    {
        return $this->belongsToMany(Box::class, 'box_category_ref', 'category_id', 'box_id')->withTrashed();
    }

    protected static function booted(): void
    {
        self::observe([
            CategoryObserver::class,
        ]);
    }
}
