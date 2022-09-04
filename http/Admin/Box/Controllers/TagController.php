<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ApiResourceController;
use Modules\Box\Models\Tag;
use Modules\Box\Search\TagSearch;
use Modules\Box\Resources\TagResource;
use Http\Admin\Box\Requests\TagRequest;

class TagController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Tag(),
            search: new TagSearch(),
            resourceClass: TagResource::class,
            formRequestClass: TagRequest::class,
        );
    }
}
