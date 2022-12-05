<?php

namespace Modules\Section\Models;

use App\Base\Model;
use Modules\Seo\Traits\SeoMetaModelTrait;

class Section extends Model
{
    use SeoMetaModelTrait;

    const CREATED_AT = null;

    protected $table = 'section';

    protected $casts = [
        'blocks' => 'array',
    ];
}
