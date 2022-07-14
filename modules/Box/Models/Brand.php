<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;
use App\Casts\Storage\AsFile;
use App\Casts\Storage\AsFiles;
use Modules\User\Models\User;

class Brand extends Model
{
    use SoftDeletes;
    use SeoMetaModelTrait;

    protected $table = 'box_brand';

    protected $guarded = [
        'creator_id',
        'is_active',
    ];

    protected $casts = [
        'file' => AsFile::class,
        'files_list' => AsFiles::class,
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->withTrashed();
    }

    public function boxes()
    {
        return $this->hasMany(Box::class, 'brand_id');
    }
}
