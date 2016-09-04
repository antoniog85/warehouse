<?php

namespace Warehouse\Transformer\HttpRequestToEntity;

use Illuminate\Http\Request;
use Warehouse\Entity\EntityInterface;
use Warehouse\Entity\Warehouse\WarehouseEntity;
use Warehouse\Transformer\HttpRequestToEntity\TransformableToEntity;

class WarehouseFromIlluminateToEntityTransformer implements TransformableToEntity
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function transform(): EntityInterface
    {
        $warehouse = new WarehouseEntity();
        $warehouse
            ->setName($this->request->get('name'))
            ->setNote($this->request->get('note'));

        return $warehouse;
    }
}