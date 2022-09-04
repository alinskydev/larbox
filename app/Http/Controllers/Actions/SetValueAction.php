<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Model;

class SetValueAction extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(Model $model, mixed $value)
    {
        $field = request()->route()->bindingFieldFor('field');

        if (!$field) {
            throw new \Exception("'field' parameter must be binded");
        }

        $model->$field = $value;

        try {
            $model->save();
        } catch (\Throwable $e) {
            abort(403, $e->getMessage());
        }

        return response()->json(['message' => 'Success'], 200);
    }
}
