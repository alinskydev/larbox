<?php

namespace App\Http\Controllers;

use App\Models\Model;
use App\Search\Search;
use App\Resources\JsonResource;

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Database\Eloquent\SoftDeletes;

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
            ->filter((array)$request->get('filter'))
            ->sort((array)$request->get('sort', '-id'))
            ->show((array)$request->get('show'))
            ->setPageSize((int)$request->get('page-size'));
    }

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
        $data = $this->resourceClass::make($request->model);
        return response()->json($data, 201);
    }

    public function update(ValidatesWhenResolved $request)
    {
        $data = $this->resourceClass::make($request->model);
        return response()->json($data, 200);
    }

    public function destroy(Model $model)
    {
        $model->delete();
        return response('', 204);
    }

    public function restore(int $id)
    {
        if (in_array(SoftDeletes::class, class_uses_recursive($this->model))) {
            $this->model->query()->onlyTrashed()->findOrFail($id)->restore();
        }

        return response('', 204);
    }
}
