<?php

namespace Warehouse\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;
use Warehouse\Repository\RepositoryInterface;
use Warehouse\Transformer\EloquentToEntity\TransformableToEntity;

class EloquentRepository implements RepositoryInterface
{
    /**
     * @var TransformableToEntity
     */
    private $eloquentTransformer;

    /**
     * @var Model
     */
    private $model;

    public function __construct(TransformableToEntity $eloquentTransformer, Model $model)
    {
        $this->eloquentTransformer = $eloquentTransformer;
        $this->model = $model;
    }

    /**
     * @param int $id
     * @return EntityInterface
     */
    public function findOne(int $id): EntityInterface
    {
        $model = $this->model->find($id);
        return $this->eloquentTransformer->transform($model);
    }

    public function persist(EntityInterface $entity): EntityInterface
    {
//        $model = $this->model->firstOrCreate([
//            'name' => $entity->getName(),
//        ]);
//        return $this->eloquentTransformer->transform($model);
    }
}