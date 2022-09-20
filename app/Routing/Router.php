<?php

namespace App\Routing;

use Illuminate\Routing\Router as BaseRouter;

class Router extends BaseRouter
{
    public function deleteAll($uri, $action = null)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function restore($uri, $action = null)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function restoreAll($uri, $action = null)
    {
        return $this->addRoute('DELETE', $uri, $action);
    }

    public function apiResource($name, $controller, array $options = [])
    {
        $only = [
            'index', 'show',
            'store', 'update',
            'delete', 'deleteAll',
            'restore', 'restoreAll',
        ];

        $this->resourceParameters([$name => 'model']);

        if (isset($options['except'])) {
            $only = array_diff($only, (array) $options['except']);
        }

        return $this->resource($name, $controller, array_merge([
            'only' => $only,
        ], $options));
    }
}
