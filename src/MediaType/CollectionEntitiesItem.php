<?php

namespace Warehouse\MediaType;


class CollectionEntitiesItem
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var CollectionEntitiesItemLink
     */
    private $links;

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return CollectionEntitiesItem
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return CollectionEntitiesItemLink
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param CollectionEntitiesItemLink $links
     * @return CollectionEntitiesItem
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'data' => $this->data,
            'links' => $this->links->toArray(),
        ];
    }
}