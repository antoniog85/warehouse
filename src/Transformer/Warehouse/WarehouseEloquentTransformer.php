<?php

namespace Warehouse\Transformer\Warehouse;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;
use Warehouse\Entity\Warehouse\Warehouse;
use Warehouse\Transformer\EloquentTransformer;

class WarehouseEloquentTransformer implements EloquentTransformer
{
    /**
     * @param Model $model
     * @return EntityInterface
     */
    public function transform(Model $model): EntityInterface
    {
        $warehouse = new Warehouse();
        $warehouse->setName($model->name);

        return $warehouse;
    }
}