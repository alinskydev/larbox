<?php

namespace Http\Website\Feedback\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Http\Website\Feedback\Requests\CallbackRequest;
use Modules\Feedback\Models\Callback;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request): JsonResponse
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponse();
    }
}
