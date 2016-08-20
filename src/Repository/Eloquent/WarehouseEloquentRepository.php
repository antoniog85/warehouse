<?php

namespace Warehouse\Repository\Eloquent;

use App\Models\Warehouse as WarehouseEloquentModel;
use Warehouse\Repository\RepositoryInterface;
use Warehouse\Entity\Warehouse\Warehouse;

/**
 * Warehouse repository
 */
class WarehouseEloquentRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    /**
     * Retrieve the list of warehouses
     *
     * @param int $number
     * @return Warehouse[]
     */
    public function get(int $number): array
    {
        $data = [];
        $result = WarehouseEloquentModel::paginate(15);

        /** @var EloquentWarehouse[] $warehouses */
        $warehouses = $result->items();
        foreach ($warehouses as $warehouse) {
            $data[] = $this->transformer->transform($warehouse);
        }
        return $data;
    }
}