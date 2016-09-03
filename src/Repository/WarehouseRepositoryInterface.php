<?php

namespace Warehouse\Repository;

use Warehouse\Entity\Warehouse\WarehouseEntity;

interface WarehouseRepositoryInterface
{
    /**
     * @param int $id
     * @return WarehouseEntity
     */
    public function findOne(int $id): WarehouseEntity;

    /**
     * @param WarehouseEntity $entity
     * @return WarehouseEntity
     */
    public function persist(WarehouseEntity $entity): WarehouseEntity;
}