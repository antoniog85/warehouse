<?php

use Illuminate\Database\Seeder;

class WarehousesSeeder extends Seeder
{
    /** @return void */
    public function run()
    {
        factory(App\Warehouse::class, 50)->create();
    }
}
