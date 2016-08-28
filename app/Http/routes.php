<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Warehouse\Entity\Warehouse\WarehouseEntity;

$app->get(WarehouseEntity::URL_PATH, 'WarehouseController@get');
$app->get(WarehouseEntity::URL_PATH . '/{id}', 'WarehouseController@getById');
$app->post(WarehouseEntity::URL_PATH, 'WarehouseController@post');
