<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Warehouse\Entity\Warehouse\Warehouse;
use Warehouse\Repository\Eloquent\WarehouseEloquentRepository;

class WarehouseController extends Controller
{
    public $repository;

    /**
     * @param WarehouseEloquentRepository $repository
     */
    public function __construct(WarehouseEloquentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getList()
    {
        /** @var Warehouse[] $warehouses */
        $warehouses = $this->repository->get(15);
        $data = [];
        foreach ($warehouses as $warehouse) {
            $data[] = $warehouse->toArray();
        }
        return $data;
    }
}
