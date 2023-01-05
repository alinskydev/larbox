<?php

namespace Modules\Box\Models;

use App\Base\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Observers\Slug\SlugNameObserver;
use App\Observers\ActivateObserver;
use App\Observers\CreatorObserver;
use App\Casts\Storage\AsFile;
use App\Casts\Storage\AsFiles;

use Modules\User\Models\User;

class Brand extends Model
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box_brand';

    protected $casts = [
        'file' => AsFile::class,
        'files_list' => AsFiles::class,
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function boxes(): HasMany
    {
        return $this->hasMany(Box::class, 'brand_id');
    }

    protected static function booted(): void
    {
        self::observe([
            SlugNameObserver::class,
            ActivateObserver::class,
            CreatorObserver::class,
        ]);
    }
}
