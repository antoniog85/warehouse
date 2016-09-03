<?php

namespace App\Providers;

use App\Http\Controllers\WarehouseController;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Warehouse\Repository\Eloquent\EloquentRepository;
use Warehouse\Repository\Eloquent\EloquentCollectionJsonRepository;
use Warehouse\Transformer\HttpRequestToEntity\HttpRequestToEntity;
use Warehouse\Transformer\EloquentToEntity\WarehouseEloquentToEntityTransformer;

class WarehouseServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(WarehouseController::class)
            ->needs(EloquentCollectionJsonRepository::class)
            ->give(function ($app) {
                return new EloquentCollectionJsonRepository(
                    $app->make(WarehouseEloquentToEntityTransformer::class),
                    $app->make(EloquentRepository::class),
                    $app->make(Warehouse::class)
                );
            });

        $this->app->when(WarehouseController::class)
            ->needs(EloquentRepository::class)
            ->give(function ($app) {
                return new EloquentRepository(
                    $app->make(WarehouseEloquentToEntityTransformer::class),
                    $app->make(Warehouse::class)
                );
            });

        $this->app->when(WarehouseController::class)
            ->needs(HttpRequestToEntity::class)
            ->give(function ($app) {
                return new HttpRequestToEntity(
                    $app->make(Request::class),
                    $app->make(Warehouse::class)
                );
            });
    }

    public function provides()
    {
        return [
            EloquentCollectionJsonRepository::class,
            EloquentRepository::class,
            HttpRequestToEntity::class,
        ];
    }
}
