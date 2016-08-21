<?php

namespace Warehouse\Transformer;

use Warehouse\MediaType\CollectionJson\CollectionJsonItem;

interface CollectionJsonItemTransformer
{
    public function transform(): CollectionJsonItem;
}