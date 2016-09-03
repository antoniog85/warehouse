<?php

namespace App\Http\Controllers;

use Warehouse\Transformer\HttpRequestToEntity\HttpRequestToEntity;

final class WarehouseController extends EloquentCollectionJsonController
{
    /**
     * Set to true to enable caching
     */
    const CACHE = false;

    /**
     * Create a new warehouse
     *
     * @return array
     */
    public function post()
    {
        $warehouse = $this->httpRequestToEntity->transform();

        return $this->repository->persist($warehouse)->render();
    }

    /**
     * @return bool
     */
    protected function isCacheable()
    {
        return self::CACHE;
    }
}
