<?php

namespace Http\Admin\Storage\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CacheController extends Controller
{
    public function deleteThumbs()
    {
        $path = public_path('storage/thumbs');
        File::deleteDirectory($path);

        return $this->success();
    }
}
