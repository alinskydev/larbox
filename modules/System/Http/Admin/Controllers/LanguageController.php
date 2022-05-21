<?php

namespace Modules\System\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\System\Models\Language;
use Modules\System\Search\LanguageSearch;
use Modules\System\Http\Admin\Requests\LanguageRequest;

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
