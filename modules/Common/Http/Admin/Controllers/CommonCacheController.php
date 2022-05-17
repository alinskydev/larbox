<?php

namespace Modules\Common\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CommonCacheController extends Controller
{
    public function deleteThumbs()
    {
        $path = public_path('storage/thumbs');
        File::deleteDirectory($path);

        return response('', 204);
    }
}
