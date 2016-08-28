<?php

namespace Warehouse\MediaType;

class CollectionEntitiesItemLink
{
    /**
     * @var string
     */
    private $self;

    /**
     * @return string
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * @param string $self
     * @return CollectionEntitiesItemLink
     */
    public function setSelf($self)
    {
        $this->self = $self;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'self' => $this->self,
        ];
    }
}