<?php

namespace Warehouse\Repository;

use Warehouse\Entity\EntityInterface;

interface RepositoryInterface
{
    /**
     * @param int $id
     * @return EntityInterface
     */
    public function findOne(int $id): EntityInterface;

    /**
     * @param EntityInterface $entity
     * @return EntityInterface
     */
    public function persist(EntityInterface $entity): EntityInterface;
}