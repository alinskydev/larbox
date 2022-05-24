<?php

namespace Http\Admin\System\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\System\Models\Language;
use Modules\System\Search\LanguageSearch;
use Http\Admin\System\Requests\LanguageRequest;

class LanguageController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Language(),
            search: new LanguageSearch(),
            formRequestClass: LanguageRequest::class,
        );
    }
}
