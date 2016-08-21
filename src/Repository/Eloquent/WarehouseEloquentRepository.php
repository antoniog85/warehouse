<?php

namespace Warehouse\Repository\Eloquent;

use App\Models\Warehouse as WarehouseEloquentModel;
use Warehouse\Entity\CollectionEntities;
use Warehouse\Repository\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Warehouse repository
 */
class WarehouseEloquentRepository extends AbstractEloquentRepository implements RepositoryInterface
{
    /**
     * Retrieve the list of warehouses
     *
     * @param int $perPage
     * @param int $page
     *
     * @return CollectionEntities
     */
    public function get(int $perPage, int $page): CollectionEntities
    {
        /** @var LengthAwarePaginator $result */
        $result = WarehouseEloquentModel::paginate($perPage);
        $this->collectionEntities->setTotalItems($result->total());

        /** @var WarehouseEloquentModel[] $warehouses */
        $warehouses = $result->items();
        foreach ($warehouses as $warehouse) {
            $this->collectionEntities->addItem($this->transformer->transform($warehouse));
        }

        return $this->collectionEntities;
    }
}