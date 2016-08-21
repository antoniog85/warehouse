<?php

namespace Warehouse\MediaType\CollectionJson;

class CollectionJsonItem
{
    private $href;

    private $data;

    private $links;

    /**
     * @param string $href
     *
     * @return CollectionJsonItem
     */
    public function setHref(string $href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @param mixed $data
     *
     * @return CollectionJsonItem
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param array $links
     *
     * @return CollectionJsonItem
     */
    public function setLinks(array $links)
    {
        $this->links = $links;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'href' => $this->href,
            'data' => $this->data,
            'links' => $this->links,
        ];
    }
}