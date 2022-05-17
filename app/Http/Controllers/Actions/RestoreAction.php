<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;

class RestoreAction extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(int $id, Request $request)
    {
        $modelClass = $request->route()->bindingFieldFor('modelClass');
        
        if (!$modelClass) {
            throw new \Exception("'modelClass' parameter must be binded in route");
        }

        $model = $modelClass::query()->onlyTrashed()->findOrFail($id);
        $model->restore();

        return response('', 204);
    }
}
