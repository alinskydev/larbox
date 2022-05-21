<?php

namespace App\Http\Controllers;

use App\Models\Model;
use App\Search\Search;
use App\Resources\JsonResource;
use App\Http\Requests\ActiveFormRequest;

class ActiveController extends Controller
{
    public function __construct(
        public Model $model,
        protected Search $search,
        protected string $resourceClass = JsonResource::class,
    ) {
        $request = request();

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
        return $this->resourceClass::collection($paginator)->response()->setStatusCode(206);
    }

    public function show(Model $model)
    {
        $model = $this->search->queryBuilder->findOrFail($model->id);
        $data = $this->resourceClass::make($model);

        return response()->json($data, 200);
    }

    public function destroy(Model $model)
    {
        $model->delete();
        return response('', 204);
    }

    protected function save(ActiveFormRequest $request, int $status)
    {
        $request->model->fill($request->validated())->save();

        $data = $this->resourceClass::make($request->model);

        return response()->json($data, $status);
    }
}
