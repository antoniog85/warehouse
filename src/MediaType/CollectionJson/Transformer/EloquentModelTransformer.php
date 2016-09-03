<?php

namespace Warehouse\MediaType\CollectionJson\Transformer;

use Warehouse\MediaType\CollectionJson\CollectionJson;
use Illuminate\Database\Eloquent\Model;

class EloquentModelTransformer implements CollectionJsonTransformable
{
    /**
     * @var Model
     */
    private $result;

    public function __construct(Model $result)
    {
        $this->result = $result;
    }

    public function transform(): CollectionJson
    {
        $collectionJson = new CollectionJson();
        $collectionJson->setTotalItems(1);

        return $collectionJson;
    }
}