<?php

namespace Modules\Section\Models;

use App\Models\Model;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Modules\Section\Casts\AsBlocks;

class Section extends Model
{
    use SeoMetaModelTrait;

    const CREATED_AT = null;

    protected $table = 'section';

    protected $casts = [
        'blocks' => AsBlocks::class,
    ];
}
