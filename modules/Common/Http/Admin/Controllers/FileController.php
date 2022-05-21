<?php

namespace Modules\Common\Http\Admin\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Http\Admin\Requests\FileUploadRequest;

class FileController extends Controller
{
    public function upload(FileUploadRequest $request)
    {
        return response()->json($request->urls, 200);
    }
}
