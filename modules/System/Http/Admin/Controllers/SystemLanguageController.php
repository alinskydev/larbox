<?php

namespace Modules\System\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\System\Models\SystemLanguage;
use Modules\System\Search\SystemLanguageSearch;
use Modules\System\Resources\SystemLanguageResource;
use Modules\System\Http\Admin\Requests\SystemLanguageRequest;

class SystemLanguageController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new SystemLanguage(),
            search: new SystemLanguageSearch(),
            resourceClass: SystemLanguageResource::class
        );
    }

    public function update(SystemLanguageRequest $request)
    {
        return $this->save($request, 200);
    }
}
