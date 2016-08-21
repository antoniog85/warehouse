<?php

namespace Warehouse\Repository\Eloquent;

use Warehouse\Entity\CollectionEntities;
use Warehouse\Transformer\EloquentTransformer;

abstract class AbstractEloquentRepository
{
    /**
     * @var CollectionEntities object where to store the items found plus additional information like pagination
     */
    protected $collectionEntities;

    /**
     * @var EloquentTransformer transformer from eloquent into domain entity
     */
    protected $transformer;

    /**
     * @param CollectionEntities $collectionEntities
     * @param EloquentTransformer $transformer
     */
    public function __construct(CollectionEntities $collectionEntities, EloquentTransformer $transformer)
    {
        $this->collectionEntities = $collectionEntities;
        $this->transformer = $transformer;
    }
}