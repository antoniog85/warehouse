<?php

namespace Warehouse\MediaType\CollectionJson;

class CollectionJson
{
    /**
     * @var string
     */
    protected $version = '';

    /**
     * @var string
     */
    protected $href = '';

    /**
     * @var array
     */
    protected $error = [];

    /**
     * @var CollectionJsonItem[]
     */
    protected $items = [];

    /**
     * @var array
     */
    protected $links = [];

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @param string $href
     *
     * @return $this
     */
    public function setHref(string $href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @param $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param CollectionJsonItem $item
     *
     * @return $this
     */
    public function addItem(CollectionJsonItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param string $href
     * @param string $rel
     */
//    public function addLink(string $href, string $rel)
//    {
//        $this->links[$rel] = $href;
//    }

    /**
     * @param array $links
     * 
     * @return $this
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return array
     */
    public function render(): array
    {
        $data = [
            'collection' => [
                'version' => $this->version,
                'href' => $this->href,
                'links' => $this->links,
                'error' => $this->error,
                'items' => [],
            ]
        ];
        foreach ($this->items as $item) {
            $data['collection']['items'][] = $item->toArray();
        }
        return $data;
    }
}