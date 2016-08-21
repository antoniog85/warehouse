<?php

namespace Warehouse\Repository;

use Warehouse\Entity\CollectionEntities;

interface RepositoryInterface
{
    public function get(int $perPage, int $page): CollectionEntities;
}