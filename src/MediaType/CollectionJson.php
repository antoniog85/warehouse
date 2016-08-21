<?php

namespace Warehouse\MediaType;

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
     * @var array
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
     * @param string $error
     *
     * @return $this
     */
    public function setError(string $error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @param $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        if (!empty($items)) {
            $this->items = $items;
        }

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
    public function setLinks(array $links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return array
     */
    public function render(): array
    {
        return ['collection' => [
            'version' => $this->version,
            'href' => $this->href,
            'items' => $this->items,
            'links' => $this->links,
            'error' => $this->error,
        ]];
    }
}