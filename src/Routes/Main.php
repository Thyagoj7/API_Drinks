<?php


use App\Controllers\DrinkController;
use Slim\App;

$app = new App();

$app->group('/drinks', function (App $app) {
    $drinkController = new DrinkController($container);

    $app->get('/', [$drinkController, 'index']);
    $app->post('/', [$drinkController, 'create']);
    $app->get('/{id}', [$drinkController, 'show']);
    $app->put('/{id}', [$drinkController, 'update']);
    $app->delete('/{id}', [$drinkController, 'delete']);
});

$app->run();

/*
use App\Http\Route;

Route::get('/', 'DrinkController@index');
Route::post('/', 'DrinkCOntroller@index');
Route::put('/', 'DrinkController@index');
Route::delete('/', 'DrinkController@index');*/