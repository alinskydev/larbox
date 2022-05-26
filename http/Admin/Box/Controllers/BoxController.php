<?php

namespace Http\Admin\Box\Controllers;

use App\Http\Controllers\ActiveController;
use Modules\Box\Models\Box;
use Modules\Box\Search\BoxSearch;
use Http\Admin\Box\Requests\BoxRequest;

class BoxController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Box(),
            search: new BoxSearch(),
            formRequestClass: BoxRequest::class,
        );
    }
}
