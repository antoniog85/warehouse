<?php

namespace Warehouse\Entity;

class Link
{
    /**
     * @var string
     */
    private $rel;

    /**
     * @var string
     */
    private $href;

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     * @return Link
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
        return $this;
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
     * @return Link
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'rel' => $this->getRel(),
            'href' => $this->getHref(),
        ];
    }
}