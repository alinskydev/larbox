<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Model;
use Illuminate\Http\Request;

class SetValueAction extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(Model $model, mixed $value, Request $request)
    {
        $field = $request->route()->bindingFieldFor('field');

        if (!$field) {
            throw new \Exception("'field' parameter must be binded");
        }

        $model->$field = $value;
        $model->save();

        return response('', 204);
    }
}
