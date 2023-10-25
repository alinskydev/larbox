<?php

namespace App\NestedSet;

use App\Http\Controllers\ResourceController;
use Symfony\Component\HttpFoundation\Response;

class NestedSetController extends ResourceController
{
    public function tree(): Response
    {
        $response = $this->model->query()
            ->withTrashed()
            ->get()
            ->toTree(1)
            ->toArray();

        return response()->json($response);
    }

    public function move(NestedSetMoveRequest $request): Response
    {
        $data = $request->validatedData;

        $model = $this->model->query()->findOrFail($data['id']);
        $node = $this->model->query()->findOrFail($data['node_id']);

        switch ($data['type']) {
            case 'before':
                $model->insertBeforeNode($node);
                break;

            case 'after':
                $model->insertAfterNode($node);
                break;

            case 'into':
                $node->appendNode($model);
                break;
        }

        return $this->successResponse();
    }
}
