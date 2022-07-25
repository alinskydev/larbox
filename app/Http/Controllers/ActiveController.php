<?php

namespace App\Http\Controllers;

use App\Models\Model;
use App\Search\Search;
use App\Resources\JsonResource;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ActiveController extends Controller
{
    public function __construct(
        public Model $model,
        protected Search $search,
        protected string $resourceClass = JsonResource::class,
        protected ?string $formRequestClass = null,
    ) {
        // Binding FormRequest class

        $request = request();

        if (!$this->formRequestClass && in_array($request->route()->getActionMethod(), ['store', 'update'])) {
            throw new \Exception("'formRequestClass' must be set");
        }

        app()->bind(ValidatesWhenResolved::class, $this->formRequestClass);

        // Binding model for FormRequest

        Route::model('model', $this->model::class);
        $request->route()->setBindingFields(['new_model' => $this->model]);

        // Searching

        $this->search->setQueryBuilder($this->model->query())
            ->join((array)$request->get('with'))
            ->filter((array)$request->get('filter'), Search::COMBINED_TYPE_AND)
            ->combinedFilter((array)$request->get('filter'))
            ->sort((array)$request->get('sort', '-id'))
            ->show((array)$request->get('show'))
            ->setPageSize((int)$request->get('page-size'));
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
        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function store(ValidatesWhenResolved $request)
    {
        $response = ['message' => 'Successfully saved'];
        return response()->json($response, 201);
    }

    public function update(ValidatesWhenResolved $request)
    {
        $response = ['message' => 'Successfully saved'];
        return response()->json($response, 200);
    }

    public function destroy(Model $model)
    {
        $model->delete();
        return response('', 204);
    }

    // Custom actions

    public function destroyAll()
    {
        $selection = (array)request()->get('selection', []);
        $models = $this->model->query()->whereIn('id', $selection)->limit(100)->get();

        DB::beginTransaction();

        $models->map(function ($value, $key) {
            $value->delete();
        });

        DB::commit();

        return response('', 204);
    }

    public function restore(int $id)
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $this->model->query()->onlyTrashed()->findOrFail($id)->restore();
        }

        return response('', 204);
    }

    public function restoreAll()
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $selection = (array)request()->get('selection', []);
            $models = $this->model->query()->whereIn('id', $selection)->onlyTrashed()->limit(100)->get();

            DB::beginTransaction();

            $models->map(function ($value, $key) {
                $value->restore();
            });

            DB::commit();
        }

        return response('', 204);
    }
}
