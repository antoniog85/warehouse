<?php

namespace Warehouse\MediaType\CollectionJson\Transformer;

use Warehouse\MediaType\CollectionJson\CollectionJson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Warehouse\MediaType\CollectionJson\CollectionJsonLink;

class LengthAwarePaginatorTransformer implements CollectionJsonTransformable
{
    /**
     * @var LengthAwarePaginatorTransformer
     */
    private $result;

    public function __construct(LengthAwarePaginator $result)
    {
        $this->result = $result;
    }

    public function transform(): CollectionJson
    {
        $collectionJson = new CollectionJson();
        $collectionJson->setTotalItems($this->result->total());

        $items = $this->result->items();

        if (!count($items)) {
            return $collectionJson;
        }

        $first = (new CollectionJsonLink())->setHref($this->result->url(1))->setRel('first');
        $last = (new CollectionJsonLink())->setHref($this->result->url($this->result->lastPage()))->setRel('last');
        $next = (new CollectionJsonLink())->setHref($this->result->nextPageUrl() ?: '')->setRel('next');
        $previous = (new CollectionJsonLink())->setHref($this->result->previousPageUrl() ?: '')->setRel('previous');

        $collectionJson->setLinks($first, $last, $next, $previous);

        return $collectionJson;
    }
}