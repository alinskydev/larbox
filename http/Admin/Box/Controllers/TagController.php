<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Tag;
use Modules\Box\Search\TagSearch;
use Http\Admin\Box\Requests\TagRequest;

class TagController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Tag(),
            search: new TagSearch(),
            formRequestClass: TagRequest::class,
        );
    }
}
