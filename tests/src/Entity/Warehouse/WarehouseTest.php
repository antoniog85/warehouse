<?php

use PHPUnit_Framework_TestCase as TestCase;
use Warehouse\Entity\Warehouse\Warehouse;

class WarehouseEloquentRepositoryTest extends TestCase
{
    public function testToArrayReturnsAnArray()
    {
        $warehouseEntity = new Warehouse();
        $this->assertTrue(is_array($warehouseEntity->toArray()));
    }
}
