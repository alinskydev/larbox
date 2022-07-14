<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\UserEnums;

class EnumsController extends Controller
{
    public function index()
    {
        $response = [
            'user' => [
                'role' => UserEnums::roles(),
            ],
        ];

        return response()->json($response, 200);
    }
}
