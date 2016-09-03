<?php

namespace Warehouse\Repository\Eloquent;

use Warehouse\Entity\Warehouse\WarehouseEntity;
use App\Models\Warehouse as WarehouseModel;
use Warehouse\Repository\WarehouseRepositoryInterface;

class WarehouseEloquentRepository extends AbstractEloquentRepository implements WarehouseRepositoryInterface
{
    /**
     * @param int $id
     * @return WarehouseEntity
     */
    public function findOne(int $id): WarehouseEntity
    {
        $model = WarehouseModel::find($id);
        return $this->eloquentTransformer->transform($model);
    }

    public function persist(WarehouseEntity $entity): WarehouseEntity
    {
        $model = WarehouseModel::firstOrCreate([
            'name' => $entity->getName(),
        ]);
        return $this->eloquentTransformer->transform($model);
    }
}