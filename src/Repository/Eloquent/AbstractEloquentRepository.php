<?php

namespace Warehouse\Repository\Eloquent;

use Warehouse\Transformer\EloquentTransformerInterface;

abstract class AbstractEloquentRepository
{
    /**
     * @var EloquentTransformerInterface transformer from eloquent into domain entity
     */
    protected $eloquentTransformer;

    /**
     * @param EloquentTransformerInterface $eloquentTransformer
     */
    public function __construct(EloquentTransformerInterface $eloquentTransformer)
    {
        $this->eloquentTransformer = $eloquentTransformer;
    }
}