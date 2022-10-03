<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\User\Models\Notification;
use Modules\User\Search\NotificationSearch;
use Modules\User\Resources\NotificationResource;
use Http\Admin\User\Requests\NotificationRequest;

use App\Models\Model;

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

    public function show(Model $model)
    {
        $model->update(['is_seen' => 1]);
        return parent::show($model);
    }

    public function seeAll()
    {
        Notification::query()->update(['is_seen' => 1]);
        return $this->successResponse();
    }
}
