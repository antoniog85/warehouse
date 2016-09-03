<?php

use PHPUnit_Framework_TestCase as TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Illuminate\Database\Eloquent\Model;
use Warehouse\Entity\EntityInterface;
use Warehouse\Transformer\EloquentToEntity\WarehouseEloquentToEntityTransformer;

class WarehouseEloquentTransformerTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $model;

    public function setUp()
    {
        $this->model = $this->getMockForAbstractClass(Model::class);
    }

    public function test_it_should_return_an_entity()
    {
        $transformer = new WarehouseEloquentToEntityTransformer();
        $this->assertTrue($transformer->transform($this->model) instanceof EntityInterface);
    }
}