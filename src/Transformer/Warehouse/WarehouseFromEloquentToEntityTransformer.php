<?php

namespace Warehouse\Transformer\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;
use Warehouse\Entity\Warehouse\Warehouse;
use Warehouse\Transformer\EloquentTransformer;

class WarehouseFromEloquentToEntityTransformer implements EloquentTransformer
{
    /**
     * @param Model $model
     * @return EntityInterface
     */
    public function transform(Model $model): EntityInterface
    {
        $warehouse = new Warehouse();
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