<?php

namespace Modules\Report\Http\Public\Controllers;

use App\Http\Controllers\ApiResourceController;

use Modules\Report\Models\Report;
use Modules\Report\Search\ReportSearch;
use Modules\Report\Resources\ReportResource;
use Modules\Report\Http\Public\Requests\ReportRequest;

class ReportController extends ApiResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Report(),
            search: new ReportSearch(),
            resourceClass: ReportResource::class
        );

        $this->middleware(function ($request, $next) {
            $this->search->queryBuilder->where('creator_id', auth()->user()->id);
            return $next($request);
        });
    }

    public function store(ReportRequest $request)
    {
        return $this->save($request, 201);
    }
}
