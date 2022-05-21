<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\UserEnums;

class EnumsController extends Controller
{
    public function user()
    {
        $response = [
            'roles' => UserEnums::roles(),
        ];

        return response()->json($response, 200);
    }
}
