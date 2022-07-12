<?php

namespace Modules\Section\Models;

use App\Models\Model;
use Modules\Section\Casts\AsBlocks;

class Section extends Model
{
    const CREATED_AT = null;

    protected $table = 'section';

    protected $guarded = [
        'name',
    ];

    protected $casts = [
        'blocks' => AsBlocks::class,
    ];
}
