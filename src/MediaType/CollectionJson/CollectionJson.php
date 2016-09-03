<?php

namespace Warehouse\MediaType\CollectionJson;

use Warehouse\MediaType\MediaTypeInterface;

class CollectionJson implements MediaTypeInterface
{
    /**
     * @var string
     */
    private $version = '';

    /**
     * @var string
     */
    private $href = '';

    /**
     * @var array
     */
    private $error = [];

    /**
     * @var CollectionJsonItem[]
     */
    private $items = [];

    /**
     * @var array
     */
    private $links = [];

    /**
     * @var int
     */
    private $totalItems = 1;

    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            $this->fromArray($data);
        }
    }

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

    public function getVersion(): string
    {
        return $this->version;
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
     * @return string
     */
    public function getHref(): string
    {
        return $this->href;
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

    public function getError()
    {
        return $this->error;
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
     * @param CollectionJsonLink $link
     */
    public function addLink(CollectionJsonLink $link)
    {
        $this->links[] = $link;
    }

    /**
     * @return CollectionJsonLink[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param CollectionJsonLink[] ...$links
     * @return $this
     */
    public function setLinks(CollectionJsonLink ...$links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     * @return CollectionJson
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'collection' => [
                'version' => $this->getVersion(),
                'href' => $this->getHref(),
                'error' => $this->getError(),
                'items' => [],
                'links' => [],
            ]
        ];

        $data['total_items'] = $this->getTotalItems();

        foreach ($this->getLinks() as $link) {
            $data['collection']['links'][] = $link->toArray();
        }

        foreach ($this->items as $item) {
            $data['collection']['items'][] = $item->toArray();
        }

        return $data;
    }

    /**
     * @return array
     */
    public function render(): array
    {
        $data = $this->toArray();
        unset($data['total_items']);

        return $data;
    }

    /**
     * @param array $data
     * @return MediaTypeInterface
     */
    private function fromArray(array $data): MediaTypeInterface
    {
        isset($data['total_items']) && $this->setTotalItems($data['total_items']);
        isset($data['collection']['version']) && $this->setVersion($data['collection']['version']);
        isset($data['collection']['href']) && $this->setHref($data['collection']['href']);
        isset($data['collection']['error']) && $this->setError($data['collection']['error']);

        if (isset($data['collection']['links']) && is_array($data['collection']['links'])) {
            foreach ($data['collection']['links'] as $link) {
                $collectionJsonLink = new CollectionJsonLink($link);
                $this->addLink($collectionJsonLink);
            }
        }

        if (isset($data['collection']['items']) && is_array($data['collection']['items'])) {
            foreach ($data['collection']['items'] as $item) {
                $collectionJsonItem = new CollectionJsonItem($item);
                $this->addItem($collectionJsonItem);
            }
        }

        return $this;
    }
}