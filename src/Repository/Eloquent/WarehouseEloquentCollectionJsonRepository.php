<?php

namespace Warehouse\Repository\Eloquent;

use App\Models\Warehouse as WarehouseEloquentModel;
use Warehouse\MediaType\CollectionEntities;
use Warehouse\Entity\Warehouse\WarehouseEntity;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\Transformer\CollectionEntitiesTransformerInterface;
use Warehouse\Transformer\EloquentTransformerInterface;

class WarehouseEloquentCollectionJsonRepository
{
    /**
     * @var EloquentTransformerInterface
     */
    private $eloquentTransformer;

    /**
     * @var CollectionEntitiesTransformerInterface
     */
    private $collectionEntitiesTransformer;

    /**
     * @var WarehouseEloquentRepository
     */
    private $eloquentRepository;

    public function __construct(
        EloquentTransformerInterface $eloquentTransformer,
        CollectionEntitiesTransformerInterface $collectionEntitiesTransformer,
        WarehouseEloquentRepository $eloquentRepository
    )
    {
        $this->eloquentTransformer = $eloquentTransformer;
        $this->collectionEntitiesTransformer = $collectionEntitiesTransformer;
        $this->eloquentRepository = $eloquentRepository;
    }

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

        /** @var WarehouseEloquentModel[] $warehouses */
        $warehouses = $result->items();
        foreach ($warehouses as $warehouse) {
            $entity = $this->eloquentTransformer->transform($warehouse);
            $this->collectionEntitiesTransformer->transform($entity);
        }
        $collectionEntities = $this->collectionEntitiesTransformer->getCollectionEntities();
        $collectionEntities->setTotalItems($result->total());

        return $collectionEntities;
    }

    /**
     * @param int $id
     * @return CollectionEntities
     */
    public function getById(int $id): CollectionEntities
    {
        $entity = $this->eloquentRepository->getById($id);

        return $this->collectionEntitiesTransformer->transform($entity);
    }

    /**
     * @param WarehouseEntity $entity
     * @return CollectionEntities
     */
    public function persist(WarehouseEntity $entity): CollectionEntities
    {
        $warehouse = $this->eloquentRepository->persist($entity);

        return $this->collectionEntitiesTransformer->transform($warehouse);
    }
}