<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Warehouse\Repository\Eloquent\WarehouseEloquentRepository;
use Warehouse\Transformer\Warehouse\WarehouseEloquentTransformer;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WarehouseEloquentRepository::class, function ($app) {
            return new WarehouseEloquentRepository(new WarehouseEloquentTransformer());
        });
    }
}
