<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;
use App\Base\Model;

use Modules\User\Models\Notification;
use Modules\User\Search\NotificationSearch;
use Modules\User\Resources\NotificationResource;
use Http\Admin\User\Requests\NotificationRequest;

class NotificationController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Notification(),
            search: new NotificationSearch(),
            resourceClass: NotificationResource::class,
            formRequestClass: NotificationRequest::class,
        );
    }

    public function show(Model $model): JsonResponse
    {
        $model->update(['is_seen' => 1]);
        return parent::show($model);
    }

    public function seeAll(): JsonResponse
    {
        Notification::query()->update(['is_seen' => 1]);
        return $this->successResponse();
    }
}
