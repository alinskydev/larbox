<?php

namespace App\Routing;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'restore'];

    protected static $verbs = [
        'create' => 'create',
        'edit' => 'edit',
        'restore' => 'restore',
    ];

    protected function addResourceRestore($name, $base, $controller, $options)
    {
        $name = $this->getShallowName($name, $options);

        $uri = $this->getResourceUri($name) . '/{id}/' . static::$verbs['restore'];

        $action = $this->getResourceAction($name, $controller, 'restore', $options);

        return $this->router->restore($uri, $action);
    }
}
