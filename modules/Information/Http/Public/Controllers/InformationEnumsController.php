<?php

namespace Modules\Information\Http\Public\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Enums\UserEnums;

class InformationEnumsController extends Controller
{
    public function user()
    {
        $responce = [
            'roles' => UserEnums::roles(),
        ];

        return response()->json($responce, 200);
    }
}
