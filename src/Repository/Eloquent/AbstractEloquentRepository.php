<?php

namespace Warehouse\Repository\Eloquent;

use Warehouse\Transformer\EloquentTransformer;

abstract class AbstractEloquentRepository
{
    /**
     * @var EloquentTransformer
     */
    protected $transformer;

    /**
     * @param EloquentTransformer $transformer
     */
    public function __construct(EloquentTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
}