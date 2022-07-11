<?php

namespace Modules\Page\Models;

use App\Models\Model;
use Modules\Page\Casts\AsBlocks;

class Page extends Model
{
    const CREATED_AT = null;

    protected $table = 'page';

    protected $guarded = [
        'name',
    ];

    protected $casts = [
        'blocks' => AsBlocks::class,
    ];
}
