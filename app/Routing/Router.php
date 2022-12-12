<?php

namespace App\Routing;

use Illuminate\Routing\Router as BaseRouter;
use Illuminate\Routing\PendingResourceRegistration;

class Router extends BaseRouter
{
    public function apiResource($name, $controller, array $options = []): PendingResourceRegistration
    {
        $only = [
            'index', 'show',
            'create', 'update',
            'delete', 'deleteAll',
            'restore', 'restoreAll',
        ];

        $this->resourceParameters([$name => 'model']);

        if (isset($options['except'])) {
            $only = array_diff($only, (array)$options['except']);
        }

        $options = array_merge(['only' => $only], $options);

        return $this->resource($name, $controller, $options);
    }
}
