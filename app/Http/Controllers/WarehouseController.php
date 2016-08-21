<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller;
use Redis;
use Warehouse\Repository\Eloquent\WarehouseEloquentRepository;

class WarehouseController extends Controller
{
    /**
     * @var WarehouseEloquentRepository
     */
    public $repository;

    /**
     * @var Redis
     */
    public $cache;

    /**
     * @param WarehouseEloquentRepository $repository
     */
    public function __construct(WarehouseEloquentRepository $repository)
    {
        $this->repository = $repository;
        $this->cache = app('redis');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function getList(Request $request)
    {
        $perPage = $request->get('per_page', 0);
        $page = $request->get('page', 0);
        $cacheKey = __CLASS__.':'.__FUNCTION__.$perPage.$page;

//        if ($this->cache->exists($cacheKey)) {
//            return json_decode($this->cache->get($cacheKey), true);
//        }

        $collectionEntities = $this->repository->get($perPage, $page);
        $data = $collectionEntities->toJson();
//        $this->cache->set($cacheKey, $data);

        return new Response($data);
    }
}
