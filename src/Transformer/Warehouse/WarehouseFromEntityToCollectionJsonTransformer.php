<?php

namespace Warehouse\Transformer\Warehouse;

use Warehouse\Entity\Warehouse\Warehouse;
use Warehouse\MediaType\CollectionJson\CollectionJsonItem;
use Warehouse\Transformer\CollectionJsonItemTransformer;

class WarehouseFromEntityToCollectionJsonTransformer implements CollectionJsonItemTransformer
{
    private $entity;

    public function __construct(Warehouse $entity)
    {
        $this->entity = $entity;
    }

    public function transform(): CollectionJsonItem
    {
        $item = new CollectionJsonItem();
        $item
            ->setData($this->entity->toArray())
            ->setHref($this->entity->getMediaTypeUrl())
            ->setLinks($this->entity->getMediaTypeLinks());
        return $item;
    }
}