<?php

namespace Http\Admin\Storage\Controllers;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

use Http\Admin\Storage\Requests\Upload\MediaRequest;

class UploadController extends Controller
{
    public function media(MediaRequest $request): Response
    {
        return response()->json(['url' => asset($request->validatedData['file'])], 200);
    }
}
