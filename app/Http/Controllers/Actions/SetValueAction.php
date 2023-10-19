<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

class SetValueAction extends Controller
{
    public function __invoke(string $pk, string $value): Response
    {
        $model = request()->route()->bindingFieldFor('model');
        $field = request()->route()->bindingFieldFor('field');

        if (!$model || !$field) throw new \Exception("Parameters 'model' and 'field' must be binded");

        $model = $model($pk);
        $model->safelySave([$field => $value]);

        return $this->successResponse();
    }
}
