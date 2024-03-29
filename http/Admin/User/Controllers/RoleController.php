<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Symfony\Component\HttpFoundation\Response;

use Modules\User\Models\Role;
use Modules\User\Search\RoleSearch;
use Modules\User\Resources\RoleResource;
use Http\Admin\User\Requests\RoleRequest;
use Modules\User\Helpers\RoleHelper;

class RoleController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Role(),
            search: new RoleSearch(),
            resourceClass: RoleResource::class,
            formRequestClass: RoleRequest::class,
        );
    }

    public function availableRoutes(): Response
    {
        $routes = RoleHelper::routesTree(true);
        return response()->json($routes);
    }
}
