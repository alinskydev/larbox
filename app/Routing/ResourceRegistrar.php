<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected $resourceDefaults = [
        'index', 'show',
        'create', 'store',
        'edit', 'update',
        'destroyAll',
        'restore', 'restoreAll',
        'destroy',
    ];

    protected function addResourceDestroyAll($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/destroy-all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'destroyAll', $options);

        return $this->router->destroyAll($uri, $action);
    }

    protected function addResourceRestore($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{id}/restore';

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->restore($uri, $action);
    }

    protected function addResourceRestoreAll($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/restore-all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'restoreAll', $options);

        return $this->router->destroyAll($uri, $action);
    }
}
