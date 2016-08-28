<?php

namespace Warehouse\Transformer\Warehouse;


use Illuminate\Http\Request;
use Warehouse\Entity\EntityInterface;
use Warehouse\Entity\Warehouse\WarehouseEntity;
use Warehouse\Transformer\IlluminateRequestTransformerInterface;

/**
 * Class WarehouseFromIlluminateRequestToEntityTransformer
 * @package Warehouse\Transformer\Warehouse
 */
class WarehouseFromIlluminateRequestToEntityTransformer implements IlluminateRequestTransformerInterface
{
    public function transform(Request $request): EntityInterface
    {
        $warehouse = new WarehouseEntity();
        $warehouse
            ->setName($request->get('name'))
            ->setNote($request->get('note'));

        return $warehouse;
    }
}