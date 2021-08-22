<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactTypeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\IndustryTypeController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::resource('city', CityController::class)->only(['index','store','show','update','destroy']);

Route::resource('country', CountryController::class)->only(['index','store','show','update','destroy']);

Route::resource('contact_type', ContactTypeController::class)->only(['index','store','show','update','destroy']);

Route::resource('industry_type', IndustryTypeController::class)->only(['index','store','show','update','destroy']);

Route::resource('client', ClientController::class)->only(['index','store','show','update','destroy']);
