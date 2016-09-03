<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Warehouse\Repository\Eloquent\WarehouseEloquentCollectionJsonRepository;
use Warehouse\Repository\Eloquent\WarehouseEloquentRepository;
use Warehouse\Transformer\Warehouse\WarehouseFromEloquentToEntityTransformer;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WarehouseEloquentRepository::class, function($app) {
            return new WarehouseEloquentRepository(
                $app->make(WarehouseFromEloquentToEntityTransformer::class)
            );
        });

        $this->app->singleton(WarehouseEloquentCollectionJsonRepository::class, function ($app) {
            return new WarehouseEloquentCollectionJsonRepository(
                $app->make(WarehouseFromEloquentToEntityTransformer::class),
                $app->make(WarehouseEloquentRepository::class)
            );
        });
    }

    public function provides()
    {
        return [
            WarehouseEloquentRepository::class,
            WarehouseEloquentCollectionJsonRepository::class
        ];
    }
}
