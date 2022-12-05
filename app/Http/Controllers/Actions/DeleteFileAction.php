<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use App\Base\Model;
use App\Helpers\FileHelper;
use Illuminate\Support\Arr;

class DeleteFileAction extends Controller
{
    public function __invoke(Model $model, string $field, ?string $index = null): JsonResponse
    {
        $model->timestamps = false;

        $value = $model->getRawOriginal($field);
        $isArray = json_decode($value) !== null;

        if ($isArray) {
            if ($index === null) abort(400, "'index' is required");

            $value = json_decode($value, true);

            if ($file = Arr::get($value, $index)) {
                Arr::forget($value, $index);

                $value = array_values($value);
                $value = json_encode($value);
                $model->setRawAttributes([$field => $value])->save();

                FileHelper::delete(public_path($file));
            }
        } else {
            $model->setRawAttributes([$field => null])->save();
            FileHelper::delete(public_path($value));
        }

        return $this->successResponse();
    }
}
