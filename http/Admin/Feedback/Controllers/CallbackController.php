<?php

namespace Http\Admin\Feedback\Controllers;

use App\Http\Controllers\ResourceController;
use Symfony\Component\HttpFoundation\Response;

use Modules\Feedback\Models\Callback;
use Modules\Feedback\Search\CallbackSearch;
use Modules\Feedback\Resources\CallbackResource;

class CallbackController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Callback(),
            search: new CallbackSearch(),
            resourceClass: CallbackResource::class,
        );
    }
}
