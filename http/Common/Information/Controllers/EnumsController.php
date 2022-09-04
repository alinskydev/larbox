<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;

class EnumsController extends Controller
{
    public function index()
    {
        $response = [];

        return response()->json($response, 200);
    }
}
