<?php

namespace Warehouse\Repository\Eloquent;

use App\Models\Warehouse as WarehouseEloquentModel;
use Warehouse\Entity\Warehouse\WarehouseEntity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\MediaType\CollectionJson\CollectionJson;
use Warehouse\MediaType\CollectionJson\CollectionJsonItem;
use Warehouse\MediaType\CollectionJson\CollectionJsonLink;
use Warehouse\MediaType\CollectionJson\Transformer\CollectionJsonTransformer;
use Warehouse\Transformer\EloquentTransformerInterface;

class WarehouseEloquentCollectionJsonRepository
{
    /**
     * @var EloquentTransformerInterface
     */
    private $eloquentTransformer;

    /**
     * @var WarehouseEloquentRepository
     */
    private $eloquentRepository;

    public function __construct(
        EloquentTransformerInterface $eloquentTransformer,
        WarehouseEloquentRepository $eloquentRepository
    )
    {
        $this->eloquentTransformer = $eloquentTransformer;
        $this->eloquentRepository = $eloquentRepository;
    }

    /**
     * Retrieve the list of warehouses
     *
     * @param int $perPage
     * @param int $page
     *
     * @return CollectionJson
     */
    public function findAll(int $perPage, int $page): CollectionJson
    {
        /** @var LengthAwarePaginator $result */
        $result = WarehouseEloquentModel::paginate($perPage);
        $result->appends('per_page', $perPage);

        $collectionJsonTransformer = new CollectionJsonTransformer($result);
        $collectionJson = $collectionJsonTransformer->transform();

        /** @var WarehouseEloquentModel[] $items */
        $items = $result->items();
        foreach ($items as $item) {
            $entity = $this->eloquentTransformer->transform($item);
            $collectionJsonItem = new CollectionJsonItem();
            $collectionJsonItem->setData($entity->toArray());
            $collectionJsonItem->setHref("http://$_SERVER[HTTP_HOST]/" . WarehouseEntity::URL_PATH . '/' . $item->id);
            $collectionJson->addItem($collectionJsonItem);
        }

        return $collectionJson;
    }

    /**
     * @param int $id
     * @return CollectionJson
     */
    public function findOne(int $id): CollectionJson
    {
        $entity = $this->eloquentRepository->findOne($id);

        $collectionJson = new CollectionJson();
        $collectionJsonItem = new CollectionJsonItem();
        $collectionJsonItem
            ->setData($entity->toArray())
            ->setHref("http://$_SERVER[HTTP_HOST]/" . WarehouseEntity::URL_PATH . '/' . $id);
        $collectionJson->addItem($collectionJsonItem);
        $warehousesListUrl = "http://$_SERVER[HTTP_HOST]/" . WarehouseEntity::URL_PATH;
        $list = (new CollectionJsonLink())->setRel('list')->setHref($warehousesListUrl);
        $collectionJson->addLink($list);

        return $collectionJson;
    }

    /**
     * @param WarehouseEntity $entity
     * @return CollectionJson
     */
    public function persist(WarehouseEntity $entity): CollectionJson
    {
        $warehouse = $this->eloquentRepository->persist($entity);

        $collectionJson = new CollectionJson();
        $collectionJsonItem = new CollectionJsonItem();
        $collectionJsonItem->setData($warehouse->toArray());
        $collectionJson->addItem($collectionJsonItem);

        return $collectionJson;
    }
}