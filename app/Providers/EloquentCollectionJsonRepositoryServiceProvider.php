<?php

namespace App\Providers;

use App\Http\Controllers\WarehouseController;
use Illuminate\Support\ServiceProvider;
use Warehouse\Repository\Eloquent\EloquentCollectionJsonRepository;

class EloquentCollectionJsonRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->when(WarehouseController::class)
            ->needs(EloquentCollectionJsonRepository::class)
            ->give(function ($app) {
                return new EloquentCollectionJsonRepository(
                    $app->make(WarehouseFromEloquentToEntityTransformer::class),
                    $app->make(EloquentRepository::class),
                    $app->make(Warehouse::class)
                );
            });
    }
}