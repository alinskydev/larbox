<?php

namespace Http\Admin\User\Controllers;

use App\Http\Controllers\ResourceController;
use Modules\User\Models\Role;
use Modules\User\Search\RoleSearch;
use Modules\User\Resources\RoleResource;
use Http\Admin\User\Requests\RoleRequest;

use Modules\User\Helpers\Role\AdminRoleHelper;

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

    public function routesTree(string $prefix)
    {
        $helper = match ($prefix) {
            'admin' => new AdminRoleHelper(false),
        };

        $response = $helper->routesTree()[$prefix];
        return response()->json($response, 200);
    }
}
