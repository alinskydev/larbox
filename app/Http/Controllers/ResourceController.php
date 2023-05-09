<?php

namespace App\Http\Controllers;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Search;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;

class ResourceController extends Controller
{
    public function __construct(
        public Model $model,
        protected ?Search $search = null,
        protected ?string $resourceClass = null,
        protected ?string $formRequestClass = null,
    ) {
        Route::model('model', $this->model::class);

        $this->middleware(function ($request, $next) {
            if ($this->search !== null) {
                $this->search->setQuery($this->model->query())
                    ->with((array)$request->get('with'))
                    ->filter((array)$request->get('filter'))
                    ->sort((array)$request->get('sort'))
                    ->show((array)$request->get('show'))
                    ->setPageSize((int)$request->get('page-size'))
                    ->extraQuery();
            }

            if ($this->formRequestClass !== null) {
                app()->bind(ValidatesWhenResolved::class, $this->formRequestClass);
            }

            return $next($request);
        });
    }

    public function index(): JsonResponse
    {
        $paginator = $this->search->query->paginate($this->search->pageSize);
        return $this->resourceClass::collection($paginator)->response()->setStatusCode(206);
    }

    public function show(Model $model): JsonResponse
    {
        $model = $this->search->query->findOrFail($model->getKey());

        if (in_array(SeoMetaModelTrait::class, class_uses_recursive($model))) {
            $model->append(['seo_meta', 'seo_meta_as_array']);
        }

        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function create(ValidatesWhenResolved $request): JsonResponse
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponse(201);
    }

    public function update(ValidatesWhenResolved $request): JsonResponse
    {
        $request->model->safelySave($request->validatedData);
        return $this->successResponse();
    }

    public function delete(Model $model): JsonResponse
    {
        $model->safelyDelete();
        return $this->successResponse();
    }

    public function restore(string $value): JsonResponse
    {
        if (!in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            abort(400, 'Model doesn\'t use soft delete trait');
        }

        $this->model->query()->onlyTrashed()->findOrFail($value)->safelyRestore();
        return $this->successResponse();
    }

    public function deleteMultiple(): JsonResponse
    {
        $selection = (array)request()->get('selection', []);

        $models = $this->model->query()
            ->whereIn($this->model->getRouteKeyName(), $selection)
            ->limit($this->search->pageSize)
            ->get();

        $this->model->safelyDBProcess(function () use ($models) {
            $models->each(function ($model, $key) {
                $model->delete();
            });
        });

        return $this->successResponse();
    }

    public function restoreMultiple(): JsonResponse
    {
        if (!in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            abort(400, 'Model doesn\'t use soft delete trait');
        }

        $selection = (array)request()->get('selection', []);

        $models = $this->model->query()
            ->whereIn($this->model->getRouteKeyName(), $selection)
            ->limit($this->search->pageSize)
            ->onlyTrashed()
            ->get();

        $this->model->safelyDBProcess(function () use ($models) {
            $models->each(function ($model, $key) {
                $model->restore();
            });
        });

        return $this->successResponse();
    }
}
