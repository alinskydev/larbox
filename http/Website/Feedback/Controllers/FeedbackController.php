<?php

namespace Http\Website\Feedback\Controllers;

use App\Http\Controllers\Controller;
use Http\Website\Feedback\Requests\CallbackRequest;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request)
    {
        return $this->successResponse();
    }
}
