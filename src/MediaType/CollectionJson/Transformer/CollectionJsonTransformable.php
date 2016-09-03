<?php

namespace Warehouse\MediaType\CollectionJson\Transformer;

use Warehouse\MediaType\CollectionJson\CollectionJson;

interface CollectionJsonTransformable
{
    public function transform(): CollectionJson;
}