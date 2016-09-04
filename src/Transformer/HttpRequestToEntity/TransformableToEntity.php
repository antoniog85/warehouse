<?php

namespace Warehouse\Transformer\HttpRequestToEntity;

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