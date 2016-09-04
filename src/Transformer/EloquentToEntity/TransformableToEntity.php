<?php

namespace Warehouse\Transformer\EloquentToEntity;

use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;

interface TransformableToEntity
{
    /**
     * Transform into an entity
     *
     * @param Model $model
     * @return EntityInterface
     */
    public function transform(Model $model): EntityInterface;
}