<?php

namespace Warehouse\Repository;

use Warehouse\Entity\EntityInterface;
use Warehouse\MediaType\CollectionJson\CollectionJson;

interface CollectionJsonRepositoryInterface
{
    /**
     * @param int $perPage
     * @param int $page
     * @return CollectionJson
     */
    public function findAll(int $perPage, int $page): CollectionJson;

    /**
     * @param int $id
     * @return CollectionJson
     */
    public function findOne(int $id): CollectionJson;

    /**
     * @param EntityInterface $entityToPersist
     * @return CollectionJson
     */
    public function persist(EntityInterface $entityToPersist): CollectionJson;
}