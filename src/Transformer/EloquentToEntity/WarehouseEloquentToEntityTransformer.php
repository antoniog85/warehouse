<?php

namespace Warehouse\Transformer\EloquentToEntity;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;
use Warehouse\Entity\Warehouse\WarehouseEntity;

/**
 * Transform an eloquent model into a domain entity
 */
class WarehouseEloquentToEntityTransformer implements TransformableToEntity
{
    /**
     * @param Model $model
     * @return EntityInterface
     */
    public function transform(Model $model): EntityInterface
    {
        $warehouse = new WarehouseEntity();
        $warehouse
            ->setId($model->id)
            ->setName($model->name)
            ->setNote($model->note)
            ->setCreatedAt($model->created_at)
            ->setUpdatedAt($model->update_at)
            ->setDeletedAt($model->delete_at);

        return $warehouse;
    }
}