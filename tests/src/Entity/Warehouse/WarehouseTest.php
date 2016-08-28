<?php

use PHPUnit_Framework_TestCase as TestCase;
use Warehouse\Entity\Warehouse\WarehouseEntity;

class WarehouseEloquentRepositoryTest extends TestCase
{
    public function test_it_should_return_an_array()
    {
        $warehouseEntity = new WarehouseEntity();
        $this->assertTrue(is_array($warehouseEntity->toArray()));
    }
}
