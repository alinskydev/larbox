<?php

namespace Http\Admin\Storage\Controllers;

use App\Base\Controller;
use Http\Admin\Storage\Requests\Upload\FileRequest;
use Http\Admin\Storage\Requests\Upload\MediaRequest;

class UploadController extends Controller
{
    public function file(FileRequest $request)
    {
        return response()->json($request->url, 200);
    }

    public function media(MediaRequest $request)
    {
        return response()->json($request->url, 200);
    }
}
