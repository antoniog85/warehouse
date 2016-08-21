<?php

namespace Warehouse\Repository\Eloquent;

use App\Models\Warehouse as WarehouseEloquentModel;
use Illuminate\Http\Response;
use Warehouse\Entity\CollectionEntities;
use Warehouse\Repository\RepositoryInterface;

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
        $result = WarehouseEloquentModel::paginate($perPage);
        $this->collectionEntities->setTotalItems($result->total());
//        $data = [];
//        $data['total'] = $result->total();
//        $data['currentPage'] = $result->currentPage();

        /** @var WarehouseEloquentModel[] $warehouses */
        $warehouses = $result->items();
        foreach ($warehouses as $warehouse) {
            $this->collectionEntities->addItem($this->transformer->transform($warehouse));
        }
//        $response = new Response();
//        $response->setContent()
        return $this->collectionEntities;
    }
}