<?php

namespace Warehouse\Entity;

use Warehouse\Entity\Warehouse\Warehouse;

/**
 * Class responsible for transforming a acollection of entities into a suitable format for the collectionJson mediatype
 */
class CollectionEntities
{
    /**
     * @var array array of items retrieved
     */
    private $items = [];

    /**
     * @var int total items stored in the database, and not necessarily retrieved in this collection
     */
    private $totalItems = 0;

    /**
     * @var array
     */
    private $links = [];

    /**
     * @param EntityInterface $entity
     */
    public function addItem(EntityInterface $entity)
    {
        $this->items[] = [
            'href' => $this->buildEntityUrl($entity->getId()),
            'data' => $entity->toArray(),
            'links' => $entity->getLinks(),
        ];
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     */
    public function setTotalItems(int $totalItems)
    {
        $this->totalItems = $totalItems;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    private function toArray(): array
    {
        return [
            'items' => $this->items,
            'total_items' => $this->totalItems,
            'links' => $this->links,
        ];
    }

    /**
     * @param int $id
     *
     * @return string
     */
    private function buildEntityUrl(int $id): string
    {
        return getenv('REQUEST_SCHEME').'://'.getenv('SERVER_NAME').'/'.Warehouse::URL_PATH.'/'.$id;
    }
}