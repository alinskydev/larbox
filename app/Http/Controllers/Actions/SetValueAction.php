<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;
use App\Base\Model;

class SetValueAction extends Controller
{
    public function __invoke(Model $model, string $value): JsonResponse
    {
        $field = request()->route()->bindingFieldFor('field');

        if (!$field) throw new \Exception("'field' parameter must be binded");

        $model->safelySave([$field => $value]);

        return $this->successResponse();
    }
}
