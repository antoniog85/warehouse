<?php

namespace Warehouse\Entity;

/**
 * Representation of the ORM query result
 */
class CollectionEntities
{
    /**
     * @var EntityInterface[] array of items retrieved
     */
    protected $items = [];

    /**
     * @var int total items stored in the database, and not necessarily retrieved in this collection
     */
    protected $totalItems = 0;

    /**
     * @var array links related to this collection of entities
     */
    protected $links = [];

    /**
     * @param EntityInterface $entity
     */
    public function addItem(EntityInterface $entity)
    {
        $this->items[] = $entity;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
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