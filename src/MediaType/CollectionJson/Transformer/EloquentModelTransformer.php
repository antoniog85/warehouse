<?php

namespace Warehouse\MediaType\CollectionJson\Transformer;

use Warehouse\MediaType\CollectionJson\CollectionJson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\MediaType\CollectionJson\CollectionJsonLink;
use Illuminate\Database\Eloquent\Model;

class EloquentModelTransformer implements CollectionJsonTransformable
{
    /**
     * @var Model
     */
    private $result;

    public function __construct(Model $result)
    {
        $this->result = $result;
    }

    public function transform(): CollectionJson
    {
        $collectionJson = new CollectionJson();
        $collectionJson->setTotalItems(1);

//        foreach ($items as $item) {
////            $entity = $this->eloquentTransformer->transform($warehouse);
//            $collectionJsonItem = new CollectionJsonItem();
//            $collectionJsonItem->setData($item->toArray());
////            $collectionJsonItem->setHref(WarehouseEntity::URL_PATH . '/' . $warehouse->id);
//            $collectionJson->addItem($collectionJsonItem);
//        }

//        $warehouses = $result->items();
//        foreach ($warehouses as $warehouse) {
//            $entity = $this->eloquentTransformer->transform($warehouse);
//            $this->collectionEntitiesTransformer->transform($entity);
//        }
//        $collectionEntities = $this->collectionEntitiesTransformer->getCollectionEntities();
//        $collectionEntities->setTotalItems($totalRows);
//
//        $collectionEntities->addPagination(
//            $result->url(1),
//            $result->url($result->lastPage()),
//            $result->nextPageUrl() ?: '',
//            $result->previousPageUrl() ?: ''
//        );

//        return $collectionEntities;

        return $collectionJson;
    }
}