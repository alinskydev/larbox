<?php

namespace Http\Website\Box\Controllers;

use App\Http\Controllers\ResourceController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

use Modules\Box\Models\Brand;
use Modules\Box\Search\BrandSearch;
use Modules\Box\Resources\BrandResource;
use Http\Website\Box\Requests\BrandRequest;

class BrandController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(
            model: new Brand(),
            search: new BrandSearch(),
            resourceClass: BrandResource::class,
            formRequestClass: BrandRequest::class,
        );

        Route::bind('model', function ($value) {
            return $this->model->query()
                ->filterByUser('creator_id')
                ->where('slug', $value)
                ->firstOrFail();
        });

        $this->middleware(function ($request, $next) {
            $this->search->query
                ->filterByUser('creator_id')
                ->withoutTrashed();

            return $next($request);
        });
    }
}
