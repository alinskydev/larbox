<?php

namespace App\Routing;

use Illuminate\Routing\Router as BaseRouter;
use Illuminate\Routing\PendingResourceRegistration;

class Router extends BaseRouter
{
    public function apiResource($name, $controller, array $options = []): PendingResourceRegistration
    {
        $options['names']['deleteMultiple'] = $name ? "$name.delete-multiple" : 'delete-multiple';
        $options['names']['restoreMultiple'] = $name ? "$name.restore-multiple" : 'restore-multiple';

        $only = [
            'index', 'show',
            'create', 'update',
            'delete', 'restore',
            'deleteMultiple', 'restoreMultiple',
        ];

        $this->resourceParameters([$name => 'model']);

        if (isset($options['except'])) {
            $only = array_diff($only, (array)$options['except']);
        }

        $options = array_merge(['only' => $only], $options);

        return $this->resource($name, $controller, $options);
    }
}
