<?php

namespace Http\Client\Feedback\Controllers;

use App\Http\Controllers\Controller;
use Http\Client\Feedback\Requests\CallbackRequest;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request)
    {
        return $this->successResponse();
    }
}
