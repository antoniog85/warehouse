<?php

namespace App\Http\Controllers;

use App\Warehouse;
use Laravel\Lumen\Routing\Controller;

class WarehouseController extends Controller
{
    public function list()
    {
        return Warehouse::all();
    }
}
