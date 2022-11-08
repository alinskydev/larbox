<?php

namespace App\Http\Controllers\Actions;

use App\Base\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Base\Model;
use App\Helpers\FileHelper;
use Illuminate\Support\Arr;

class DeleteFileAction extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(Model $model, string $field, ?string $index = null)
    {
        $value = $model->$field;

        if ($value === null) {
            return $this->successResponse();
        }

        $originalValue = $model->getRawOriginal($field);
        $isArray = json_decode($originalValue) !== null;

        if ($isArray) {
            $originalValue = json_decode($originalValue);

            if ($index === null) abort(400, "'index' is required");

            if ($file = Arr::get($originalValue, $index)) {
                Arr::forget($value, $index);

                $model->$field = array_values($value);
                $model->touch();

                FileHelper::delete(public_path($file));
            }
        } else {
            $model->$field = null;
            $model->touch();

            FileHelper::delete(public_path($originalValue));
        }

        return $this->successResponse();
    }
}
