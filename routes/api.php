<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');

Route::put('animal/{idAnimal}/customers/{idCliente}', 'App\Http\Controllers\AnimalController@setCustomer');
Route::put('customer/{idCliente}/animals/{idAnimal}', 'App\Http\Controllers\CustomerController@setAnimal');

Route::delete('animal/{idAnimal}/customers/{idCliente}', 'App\Http\Controllers\AnimalController@deleteCustomer');
Route::delete('customer/{idCliente}/animals/{idAnimal}', 'App\Http\Controllers\CustomerController@deleteAnimal');

Route::get('animal/name', 'App\Http\Controllers\AnimalController@orderByAlphabeticOrder');
Route::get('animal/breed', 'App\Http\Controllers\AnimalController@orderByBreed');
Route::get('customer/name', 'App\Http\Controllers\CustomerController@orderByAlphabeticOrder');
Route::get('customer/age', 'App\Http\Controllers\CustomerController@orderByAge');

Route::resource('animal', 'App\Http\Controllers\AnimalController');
Route::resource('customer', 'App\Http\Controllers\CustomerController');

