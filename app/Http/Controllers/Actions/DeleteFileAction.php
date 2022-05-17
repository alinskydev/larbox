<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;

class DeleteFileAction extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __invoke(Model $model, string $field, ?string $index = null)
    {
        $value = $model->$field;

        if (!$value) abort(204);

        if (is_array($value)) {
            if ($index === null) abort(404, "'index' is required");

            $file = Arr::pull($value, $index);

            if ($file) {
                File::delete(public_path($file));
                
                $model->$field = array_values($value);
                $model->saveQuietly();
            }
        } else {
            File::delete(public_path($value));
            
            $model->$field = null;
            $model->saveQuietly();
        }

        return response('', 204);
    }
}
