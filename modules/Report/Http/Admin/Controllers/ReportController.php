<?php

namespace Modules\Report\Http\Admin\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Report\Models\Report;
use Modules\Report\Search\ReportSearch;
use Modules\Report\Resources\ReportResource;
use Modules\Report\Http\Admin\Requests\ReportRequest;

class ReportController extends ApiResourceController
{
    public function __construct()
    {
        return parent::__construct(
            model: new Report(),
            search: new ReportSearch(),
            resourceClass: ReportResource::class
        );
    }

    public function store(ReportRequest $request)
    {
        return $this->save($request, 201);
    }

    public function update(ReportRequest $request)
    {
        return $this->save($request, 200);
    }
}
