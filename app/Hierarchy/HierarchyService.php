<?php

namespace App\Hierarchy;

use App\Base\ActiveService;

class HierarchyService extends ActiveService
{
    private int $size;

    public function __construct(HierarchyModel $model)
    {
        parent::__construct($model);

        $this->size = $model->rgt - $model->lft + 1;
    }

    // public function appendTo(HierarchyModel $parent)
    // {
    //     if ($parent->id == $this->model->id) {
    //         throw new \Exception('Cannot insert to self');
    //     }

    //     if ($parent->lft > $this->model->lft && $parent->rgt < $this->model->rgt) {
    //         throw new \Exception('Cannot insert to children');
    //     }
    // }

    public function appendToRoot()
    {
        $parent = $this->model->query()->findOrFail(1);

        // Next

        $this->model->query()
            ->where('lft', '>', $parent->rgt)
            ->increment('lft', $this->size);

        // Parents & next

        $this->model->query()
            ->where('rgt', '>=', $parent->rgt)
            ->increment('rgt', $this->size);

        // Self

        $this->model->lft = $parent->rgt;
        $this->model->rgt = $parent->rgt + 1;
        $this->model->depth = $parent->depth + 1;
        $this->model->saveQuietly();
    }
}
