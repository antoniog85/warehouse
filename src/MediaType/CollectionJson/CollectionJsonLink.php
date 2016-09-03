<?php

namespace Warehouse\MediaType\CollectionJson;

use Warehouse\MediaType\MediaTypeInterface;

class CollectionJsonLink implements MediaTypeInterface
{
    /**
     * @var string
     */
    private $href;

    /** @var  string */
    private $rel;

    /**
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if (!empty($data)) {
            $this->fromArray($data);
        }
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return CollectionJsonLink
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     * @return CollectionJsonLink
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'href' => $this->getHref(),
            'rel' => $this->getRel(),
        ];
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
        isset($data['rel']) && $this->setRel($data['rel']);

        return $this;
    }
}