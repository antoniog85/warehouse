<?php

namespace Warehouse\Transformer;

use Warehouse\Entity\EntityInterface;

interface TransformableToEntity
{
    /**
     * Transform into an entity
     *
     * @return EntityInterface
     */
    public function transform(): EntityInterface;
}