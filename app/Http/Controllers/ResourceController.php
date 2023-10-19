<?php

namespace App\Http\Controllers;

use App\Base\Controller;
use App\Base\Filter;
use App\Base\Model;
use App\Base\Search;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    public function __construct(
        public Model $model,
        protected ?Search $search = null,
        protected ?Filter $filter = null,
        protected ?string $resourceClass = JsonResource::class,
        protected ?string $formRequestClass = null,
    ) {
        if ($this->filter) {
            Route::bind('model', function ($value) {
                return $this->filter
                    ->process($this->model->query(), $value)
                    ->firstOrFail();
            });
        } else {
            Route::model('model', $this->model::class);
        }

        $this->middleware(function ($request, $next) {
            if ($this->search !== null) {
                $this->search->setQuery($this->model->query())
                    ->with((array)$request->get('with'))
                    ->filter((array)$request->get('filter'))
                    ->sort((array)$request->get('sort'))
                    ->show((array)$request->get('show'))
                    ->setPageSize((int)$request->get('page-size'))
                    ->extraQuery();

                if ($this->filter) {
                    $this->filter->process($this->search->query);
                }
            }

            if ($this->formRequestClass !== null) {
                app()->bind(ValidatesWhenResolved::class, $this->formRequestClass);
            }

            return $next($request);
        });
    }

    public function index(): Response
    {
        $paginator = $this->search->query->paginate($this->search->pageSize);
        return $this->resourceClass::collection($paginator)->response();
    }

    public function show(Model $model): Response
    {
        $model = $this->search->query->findOrFail($model->getKey());

        if (in_array(SeoMetaModelTrait::class, class_uses_recursive($model))) {
            $model->append(['seo_meta', 'seo_meta_as_array']);
        }

        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function create(ValidatesWhenResolved $request): Response
    {
        $request->model->safelySave($request->validatedData);
        $request->model->unsetRelations();

        $data = $this->resourceClass::make($request->model);

        return response()->json($data, 200);
    }

    public function update(ValidatesWhenResolved $request): Response
    {
        $request->model->safelySave($request->validatedData);
        $request->model->unsetRelations();

        $data = $this->resourceClass::make($request->model);

        return response()->json($data, 200);
    }

    public function delete(Model $model): Response
    {
        $model->safelyDelete();
        return $this->successResponse();
    }

    public function restore(string $value): Response
    {
        if (!in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            abort(400, 'Model doesn\'t use soft delete trait');
        }

        $this->search->query->onlyTrashed()->findOrFail($value)->safelyRestore();
        return $this->successResponse();
    }

    public function deleteMultiple(): Response
    {
        $selection = (array)request()->get('selection', []);

        $models = $this->search->query
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

    public function restoreMultiple(): Response
    {
        if (!in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            abort(400, 'Model doesn\'t use soft delete trait');
        }

        $selection = (array)request()->get('selection', []);

        $models = $this->search->query
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
