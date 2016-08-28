<?php

namespace Warehouse\Entity;

class Links
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
     *
     * @return $this
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