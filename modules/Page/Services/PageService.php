<?php

namespace Modules\Page\Services;

use App\Services\ActiveService;
use Modules\Page\Resources as Resources;
use Modules\Page\Requests as Requests;

class PageService extends ActiveService
{
    public function config()
    {
        return match ($this->model->name) {
            'home' => [
                'resource' => Resources\HomeResource::class,
                'request' => Requests\HomeRequest::class,
            ],
        };
    }
}
