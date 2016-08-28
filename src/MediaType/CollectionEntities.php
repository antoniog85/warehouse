<?php

namespace Warehouse\MediaType;

/**
 * Representation of the collection of entities that
 * needs to be transformed into a media type result.
 */
class CollectionEntities
{
    /**
     * @var CollectionEntitiesItem[] array of items retrieved
     */
    protected $items = [];

    /**
     * @var int total items stored in the database, and not necessarily retrieved in this collection
     */
    protected $totalItems = 1;

    /**
     * @var array links related to this collection of entities
     */
    protected $links = [];

    /**
     * @param CollectionEntitiesItem $item
     */
    public function addItem(CollectionEntitiesItem $item)
    {
        $this->items[] = $item;
    }

    /**
     * @return CollectionEntitiesItem[]
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
    public function toArray(): array
    {
        $data = [
            'links' => $this->links,
            'total_items' => $this->totalItems,
        ];
        foreach ($this->items as $item) {
            $data['items'][] = $item->toArray();
        }

        return $data;
    }
}