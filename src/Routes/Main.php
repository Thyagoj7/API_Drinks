<?php
use App\Http\Route;

Route::get('/', 'DrinkController@index');
Route::post('/', 'DrinkCOntroller@index');
Route::put('/', 'DrinkController@index');
Route::delete('/', 'DrinkController@index');