<?php

namespace Warehouse\Transformer\HttpRequestToEntity;

use Warehouse\Entity\EntityInterface;

interface HttpRequestTransformerInterface
{
    /**
     * Transform an http request into an entity
     *
     * @return EntityInterface
     */
    public function transform(): EntityInterface;
}