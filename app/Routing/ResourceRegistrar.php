<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Routing\Route;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected $resourceDefaults = [
        'index', 'show',
        'create', 'update',
        'delete', 'deleteAll',
        'restore', 'restoreAll',
    ];

    /**
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    protected function addResourceCreate($name, $base, $controller, $options): Route
    {
        $uri = $this->getResourceUri($name);

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'create', $options);

        return $this->router->post($uri, $action);
    }

    /**
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    protected function addResourceDelete($name, $base, $controller, $options): Route
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{' . $base . '}';

        $action = $this->getResourceAction($name, $controller, 'delete', $options);

        return $this->router->delete($uri, $action);
    }

    /**
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    protected function addResourceDeleteAll($name, $base, $controller, $options): Route
    {
        $uri = $this->getResourceUri($name) . '/delete/all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'deleteAll', $options);

        return $this->router->delete($uri, $action);
    }

    /**
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    protected function addResourceRestore($name, $base, $controller, $options): Route
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{value}/restore';

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->delete($uri, $action);
    }

    /**
     * @param string $name
     * @param string $base
     * @param string $controller
     * @param array $options
     * @return Route
     */
    protected function addResourceRestoreAll($name, $base, $controller, $options): Route
    {
        $uri = $this->getResourceUri($name) . '/restore/all';

        unset($options['missing']);

        $action = $this->getResourceAction($name, $controller, 'restoreAll', $options);

        return $this->router->delete($uri, $action);
    }
}
