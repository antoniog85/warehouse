<?php

namespace Warehouse\Transformer;

use Illuminate\Http\Request;
use Warehouse\Entity\EntityInterface;

interface IlluminateRequestTransformerInterface
{
    /**
     * Transform an http request into an entity
     *
     * @param Request $request
     * @return EntityInterface
     */
    public function transform(Request $request): EntityInterface;
}