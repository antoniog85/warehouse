<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Redis;
use Warehouse\Repository\Eloquent\EloquentCollectionJsonRepository;
use Warehouse\Transformer\HttpRequestToEntity\HttpRequestToEntity;

abstract class EloquentCollectionJsonController extends Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var EloquentCollectionJsonRepository
     */
    protected $repository;

    /**
     * @var HttpRequestToEntity
     */
    protected $httpRequestToEntity;

    /**
     * @var Redis
     */
    private $cache;

    /**
     * @param Request $request
     * @param HttpRequestToEntity $httpRequestToEntity
     * @param EloquentCollectionJsonRepository $repository
     */
    public function __construct(
        Request $request,
        HttpRequestToEntity $httpRequestToEntity,
        EloquentCollectionJsonRepository $repository
    )
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->httpRequestToEntity = $httpRequestToEntity;
        $this->cache = app('redis');
    }

    public function get()
    {
        $perPage = $this->request->get('per_page', 0);
        $page = $this->request->get('page', 0);
        $cacheKey = __CLASS__.':'.__FUNCTION__.$perPage.$page;

        if ($this->isCacheable() && $this->cache->exists($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $collectionJson = $this->repository->findAll($perPage, $page);
        $data = $collectionJson->render();
        $this->isCacheable() && $this->cache->set($cacheKey, $data);

        return $data;
    }

    public function getById(int $id)
    {
        $cacheKey = __CLASS__.':'.__FUNCTION__.$id;
        if ($this->isCacheable() && $this->cache->exists($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $data = $this->repository->findOne($id)->render();
        $this->isCacheable() && $this->cache->set($cacheKey, $data);

        return $data;
    }

    /**
     * Determine if the results are cacheable
     *
     * @return bool
     */
    abstract protected function isCacheable();
}