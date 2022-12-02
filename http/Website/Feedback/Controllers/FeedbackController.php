<?php

namespace Http\Website\Feedback\Controllers;

use App\Base\Controller;
use Illuminate\Http\JsonResponse;

use Http\Website\Feedback\Requests\CallbackRequest;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request): JsonResponse
    {
        return $this->successResponse();
    }
}
