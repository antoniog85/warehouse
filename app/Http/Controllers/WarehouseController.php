<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Redis;
use Warehouse\Repository\Eloquent\WarehouseEloquentCollectionJsonRepository;
use Warehouse\Transformer\Warehouse\WarehouseFromIlluminateRequestToEntityTransformer;

class WarehouseController extends Controller
{
    /**
     * Set to true to enable caching
     */
    const CACHE = false;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var WarehouseEloquentCollectionJsonRepository
     */
    private $repository;

    /**
     * @var Redis
     */
    private $cache;

    /**
     * @param Request $request
     * @param WarehouseEloquentCollectionJsonRepository $repository
     */
    public function __construct(Request $request, WarehouseEloquentCollectionJsonRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->cache = app('redis');
    }

    /**
     * @return string
     */
    public function get()
    {
        $perPage = $this->request->get('per_page', 0);
        $page = $this->request->get('page', 0);
        $cacheKey = __CLASS__.':'.__FUNCTION__.$perPage.$page;

        if (self::CACHE && $this->cache->exists($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $collectionEntities = $this->repository->get($perPage, $page);
        $data = $collectionEntities->toJson();
        self::CACHE && $this->cache->set($cacheKey, $data);

        return $data;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getById(int $id)
    {
        $cacheKey = __CLASS__.':'.__FUNCTION__.$id;
        if (self::CACHE && $this->cache->exists($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $data = $this->repository->getById($id)->toJson();
        self::CACHE && $this->cache->set($cacheKey, $data);

        return $data;
    }

    /**
     * @param WarehouseFromIlluminateRequestToEntityTransformer $transformer
     * @return string
     */
    public function post(WarehouseFromIlluminateRequestToEntityTransformer $transformer)
    {
        $warehouse = $transformer->transform($this->request);

        return $this->repository->persist($warehouse)->toJson();
    }
}
