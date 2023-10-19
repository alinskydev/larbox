<?php

namespace Http\Admin\System\Controllers;

use App\Http\Controllers\ResourceController;
use Symfony\Component\HttpFoundation\Response;

use Modules\System\Models\Language;
use Modules\System\Search\LanguageSearch;
use Modules\System\Resources\LanguageResource;
use Http\Admin\System\Requests\LanguageRequest;

class LanguageController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Language(),
            search: new LanguageSearch(),
            resourceClass: LanguageResource::class,
            formRequestClass: LanguageRequest::class,
        );
    }
}
