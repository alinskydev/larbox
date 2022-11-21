<?php

namespace App\Http\Controllers;

use App\Base\Controller;
use App\Base\Model;
use App\Base\Search;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Seo\Traits\SeoMetaModelTrait;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function __construct(
        public Model $model,
        protected ?Search $search = null,
        protected ?string $resourceClass = null,
        protected ?string $formRequestClass = null,
    ) {
        $request = request();

        Route::model('model', $this->model::class);

        if ($this->search !== null) {
            $this->search->setQueryBuilder($this->model->query())
                ->with((array)$request->get('with'))
                ->filter((array)$request->get('filter'), Search::COMBINED_TYPE_AND)
                ->combinedFilter((array)$request->get('filter'))
                ->sort((array)$request->get('sort'))
                ->show((array)$request->get('show'))
                ->setPageSize((int)$request->get('page-size'));
        }

        if ($this->formRequestClass !== null) {
            $request->route()->setBindingFields(['new_model' => $this->model]);
            app()->bind(ValidatesWhenResolved::class, $this->formRequestClass);
        }
    }

    // Default actions

    public function index()
    {
        $paginator = $this->search->queryBuilder->paginate($this->search->pageSize);
        $paginator->onEachSide = 0;

        return $this->resourceClass::collection($paginator)->response()->setStatusCode(206);
    }

    public function show(Model $model)
    {
        $model = $this->search->queryBuilder->findOrFail($model->id);

        if (in_array(SeoMetaModelTrait::class, class_uses_recursive($model))) {
            $model->append(['seo_meta', 'seo_meta_as_array']);
        }

        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function create(ValidatesWhenResolved $request)
    {
        return $this->successResponse(201);
    }

    public function update(ValidatesWhenResolved $request)
    {
        return $this->successResponse();
    }

    public function delete(Model $model)
    {
        try {
            $model->delete();
        } catch (\Throwable $e) {
            abort(400, $e->getMessage());
        }

        return $this->successResponse();
    }

    // Custom actions

    public function deleteAll()
    {
        $selection = (array)request()->get('selection', []);

        $models = $this->model->query()
            ->whereIn('id', $selection)
            ->limit($this->search->pageSize)
            ->get();

        DB::beginTransaction();

        try {
            $models->map(function ($value, $key) {
                $value->delete();
            });
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(400, $e->getMessage());
        }

        DB::commit();

        return $this->successResponse();
    }

    public function restore(mixed $value)
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            try {
                $this->model->query()->onlyTrashed()->findOrFail($value)->restore();
            } catch (\Throwable $e) {
                abort(400, $e->getMessage());
            }
        }

        return $this->successResponse();
    }

    public function restoreAll()
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $selection = (array)request()->get('selection', []);

            $models = $this->model->query()
                ->whereIn('id', $selection)
                ->limit($this->search->pageSize)
                ->onlyTrashed()
                ->get();

            DB::beginTransaction();

            $models->map(function ($value, $key) {
                try {
                    $value->restore();
                } catch (\Throwable $e) {
                    DB::rollBack();
                    abort(400, $e->getMessage());
                }
            });

            DB::commit();
        }

        return $this->successResponse();
    }
}
