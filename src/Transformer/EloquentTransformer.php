<?php

namespace Warehouse\Transformer;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;

interface EloquentTransformer
{
    /**
     * Transform an Eloquent Model into a domain Entity
     *
     * @param Model $model
     * @return EntityInterface
     */
    public function transform(Model $model): EntityInterface;
}