<?php

namespace Http\Common\Information\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Section\Enums\SectionEnums;
use Modules\User\Enums\UserEnums;

class EnumsController extends Controller
{
    public function index()
    {
        $response = [
            'section' => Arr::map(SectionEnums::config(), fn ($value, $key) => ['label' => $value['label']]),
            'user' => [
                'role' => UserEnums::roles(),
            ],
        ];

        return response()->json($response, 200);
    }
}
