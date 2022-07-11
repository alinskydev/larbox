<?php

namespace Modules\Block\Models;

use App\Models\Model;

class Page extends Model
{
    const CREATED_AT = null;

    protected $table = 'block_page';

    public function blocks()
    {
        return $this->hasMany(Block::class, 'page_id');
    }
}
