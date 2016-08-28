<?php

namespace Warehouse\Transformer\Warehouse;

use Warehouse\Entity\EntityInterface;
use Warehouse\MediaType\CollectionEntities;
use Warehouse\MediaType\CollectionEntitiesItem;
use Warehouse\MediaType\CollectionEntitiesItemLink;
use Warehouse\Transformer\CollectionEntitiesTransformerInterface;

class WarehouseFromEntityToCollectionEntitiesTransformer implements CollectionEntitiesTransformerInterface
{
    /**
     * @var CollectionEntities
     */
    private $collectionEntities;

    /**
     * @param CollectionEntities $collectionEntities
     */
    public function __construct(CollectionEntities $collectionEntities)
    {
        $this->collectionEntities = $collectionEntities;
    }

    /**
     * @param EntityInterface $entity
     * @return CollectionEntities
     */
    public function transform(EntityInterface $entity): CollectionEntities
    {
        $collectionEntitiesItemLink = new CollectionEntitiesItemLink();
        $collectionEntitiesItemLink->setSelf($entity->getLinks()->getSelf());

        $collectionEntitiesItem = new CollectionEntitiesItem();
        $collectionEntitiesItem
            ->setData($entity->toArray())
            ->setLinks($collectionEntitiesItemLink);

        $this->collectionEntities->addItem($collectionEntitiesItem);

        return $this->collectionEntities;
    }

    public function getCollectionEntities(): CollectionEntities
    {
        return $this->collectionEntities;
    }
}