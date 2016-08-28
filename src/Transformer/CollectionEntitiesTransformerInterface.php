<?php

namespace Warehouse\Transformer;

use Warehouse\Entity\EntityInterface;
use Warehouse\MediaType\CollectionEntities;

interface CollectionEntitiesTransformerInterface
{
    public function transform(EntityInterface $entity): CollectionEntities;

    public function getCollectionEntities(): CollectionEntities;
}