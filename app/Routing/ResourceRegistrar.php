<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected $resourceDefaults = [
        'index', 'show',
        'create', 'store',
        'edit', 'update',
        'delete', 'deleteAll',
        'restore', 'restoreAll',
    ];

    protected function addResourceDelete($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{' . $base . '}';

        $action = $this->getResourceAction($name, $controller, 'delete', $options);

        return $this->router->delete($uri, $action);
    }

    protected function addResourceDeleteAll($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/delete/all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'deleteAll', $options);

        return $this->router->deleteAll($uri, $action);
    }

    protected function addResourceRestore($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{value}/restore';

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->restore($uri, $action);
    }

    protected function addResourceRestoreAll($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/restore/all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'restoreAll', $options);

        return $this->router->restoreAll($uri, $action);
    }
}
