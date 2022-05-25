<?php

namespace Modules\Box\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Casts\Storage\AsFile;
use App\Casts\Storage\AsFiles;

class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'box_brand';

    protected $guarded = [
        'is_active',
    ];

    protected $casts = [
        'file' => AsFile::class,
        'files_list' => AsFiles::class,
    ];
}
