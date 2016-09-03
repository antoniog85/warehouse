<?php

namespace Warehouse\MediaType\CollectionJson;

use Warehouse\MediaType\MediaTypeInterface;

class CollectionJsonItem implements MediaTypeInterface
{
    /**
     * @var string
     */
    private $href;

    /**
     * @var array
     */
    private $data;

    /**
     * @var CollectionJsonLink[]
     */
    private $links = [];

    /**
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if (!empty($data))
        {
            $this->fromArray($data);
        }
    }

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

    public function getHref()
    {
        return $this->href;
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
     * @param CollectionJsonLink $link
     *
     * @return CollectionJsonItem
     */
    public function addLink(CollectionJsonLink $link)
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return CollectionJsonLink[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [
            'href' => $this->getHref(),
            'data' => $this->data,
        ];

        foreach ($this->getLinks() as $link) {
            $data['links'][] = $link->toArray();
        }

        return $data;
    }

    /**
     * @return array
     */
    public function render(): array
    {
        return $this->toArray();
    }

    /**
     * @param array $data
     * @return MediaTypeInterface
     */
    private function fromArray(array $data): MediaTypeInterface
    {
        isset($data['href']) && $this->setHref($data['href']);
        isset($data['data']) && $this->setData($data['data']);

        if (isset($data['links']) && is_array($data['links'])) {
            foreach ($data['links'] as $link) {
                $collectionJsonLink = new CollectionJsonLink($link);
                $this->addLink($collectionJsonLink);
            }
        }

        return $this;
    }
}