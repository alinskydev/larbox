<?php

namespace Http\Public\Feedback\Controllers;

use App\Http\Controllers\Controller;
use Http\Public\Feedback\Requests\CallbackRequest;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request)
    {
        return $this->successResponse();
    }
}
