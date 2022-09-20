<?php

namespace Modules\User\Helpers\Role;

use Modules\User\Helpers\RoleHelper;

class AdminRoleHelper extends RoleHelper
{
    protected string $routesPrefix = 'admin';

    protected array $excludedRoutes = [
        'information',
        'storage',
        'user.notification.index',
        'user.notification.show',
        'user.notification.seeAll',
        'user.profile',
    ];
}
