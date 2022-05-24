<?php

namespace Http\Admin\Storage\Controllers;

use App\Http\Controllers\Controller;
use Http\Admin\Storage\Requests\FileUploadRequest;

class FileController extends Controller
{
    public function upload(FileUploadRequest $request)
    {
        return response()->json($request->urls, 200);
    }
}
