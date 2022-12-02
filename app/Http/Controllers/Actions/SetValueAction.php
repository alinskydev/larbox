<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use App\Base\Model;
use Illuminate\Support\Facades\DB;

class SetValueAction extends Controller
{
    public function __invoke(Model $model, string $value): JsonResponse
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
