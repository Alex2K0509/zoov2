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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})
;*/
Route::post('/loginapi', 'App\Http\Controllers\LOGIN\LOGINcontroller@loginAPI');
Route::post('webhook/tokens', 'App\Http\Controllers\WEBHOOK\NotiWebhookController@webHooks');
Route::group(['middleware' => 'auth:api'], function () {
#API PARA OBTENER TODOS LOS EVENTOS
    Route::get('/get/eventos', 'App\Http\Controllers\APIS\ApiController@getEventos');
#API PARA OBTENER TODOS LOS ANIMALES
    Route::get('/get/animales', 'App\Http\Controllers\APIS\ApiController@getAnimales');
#API PARA OBTENER LAS PUBLICACIONES
    Route::post('/get/publicaciones', 'App\Http\Controllers\APIS\ApiController@getPublicaciones');
#RUTA PARA EL WEBHOO

});
