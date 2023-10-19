<?php

namespace Http\Website\Feedback\Controllers;

use App\Base\Controller;
use Symfony\Component\HttpFoundation\Response;

use Http\Website\Feedback\Requests\CallbackRequest;

class FeedbackController extends Controller
{
    public function callback(CallbackRequest $request): Response
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponse();
    }
}
