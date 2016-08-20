<?php

namespace Warehouse\Entity\Warehouse;

use Warehouse\Entity\EntityInterface;

/**
 * Representation of the entity Warehouse
 */
class Warehouse implements EntityInterface
{
    private $name;

    public function setName($name = '')
    {
        $this->name = (string) $name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}