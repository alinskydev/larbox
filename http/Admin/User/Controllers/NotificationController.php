<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;
use App\Base\Model;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

use Modules\User\Models\Notification;
use Modules\User\Search\NotificationSearch;
use Modules\User\Resources\NotificationResource;
use Http\Admin\User\Requests\NotificationRequest;
use Modules\User\Jobs\NotificationPrepareCreateJob;

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

    public function create(ValidatesWhenResolved $request): JsonResponse
    {
        NotificationPrepareCreateJob::dispatch(
            data: $request->validatedData,
            creatorId: request()->user()->id,
        );

        return $this->successResponse(201);
    }

    public function seeAll(): JsonResponse
    {
        Notification::query()->update(['is_seen' => 1]);
        return $this->successResponse();
    }
}
