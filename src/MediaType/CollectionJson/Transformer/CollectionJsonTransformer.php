<?php

namespace Warehouse\MediaType\CollectionJson\Transformer;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\MediaType\CollectionJson\CollectionJson;
use Warehouse\MediaType\Exception\ResultTransformerNotFound;

class CollectionJsonTransformer implements CollectionJsonTransformable
{
    /**
     * @var CollectionJsonTransformable
     */
    private $strategy;

    public function __construct($result)
    {
        if ($result instanceof LengthAwarePaginator) {
            $this->strategy = new LengthAwarePaginatorTransformer($result);
        } else {
            throw new ResultTransformerNotFound(
                sprintf('The result of type %s does not have a transformer', get_class($result))
            );
        }
    }

    /**
     * @return CollectionJson
     */
    public function transform(): CollectionJson
    {
        return $this->strategy->transform();
    }
}