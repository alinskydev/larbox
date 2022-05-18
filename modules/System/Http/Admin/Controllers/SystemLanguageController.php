<?php

namespace Modules\System\Http\Admin\Controllers;

use App\Http\Controllers\ActiveController;

use Modules\System\Models\SystemLanguage;
use Modules\System\Search\SystemLanguageSearch;
use Modules\System\Http\Admin\Requests\SystemLanguageRequest;

class SystemLanguageController extends ActiveController
{
    public function __construct()
    {
        return parent::__construct(
            model: new SystemLanguage(),
            search: new SystemLanguageSearch(),
        );
    }

    public function update(SystemLanguageRequest $request)
    {
        return $this->save($request, 200);
    }
}
