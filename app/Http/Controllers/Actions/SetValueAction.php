<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Base\Model;
use Illuminate\Support\Facades\DB;

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

        DB::beginTransaction();

        try {
            $model->save();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(400, $e->getMessage());
        }

        DB::commit();

        return $this->successResponse();
    }
}
