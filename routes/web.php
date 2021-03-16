<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/







Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('user', 'App\Http\Controllers\UserController@index')->name('user.index'); #pagina inicial

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']); #perfil del usuario
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']); #actualizar info
	Route::get('upgrade', function () {return view('pages.upgrade'); })->name('upgrade');
	Route::get('map', function () { return view('pages.maps'); })->name('map');
	Route::get('icons', function () { return view('pages.icons'); })->name('icons');
	Route::get('table-list', function () { return view('pages.tables'); })->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    #ruta para insertar eventos
    Route::post('/evento/add', 'App\Http\Controllers\Catalogos\CatalogosController@InserEvent')->name('eventoInsert');
    Route::post('/animal/add', 'App\Http\Controllers\Catalogos\CatalogosController@InsertAnimal')->name('InsertAnimal');
    #ruta para editar un evento
    #Route::get('/edit/evento', 'App\Http\Controllers\Catalogos\RecordsController@editEventos')->name('edit.eventos');
});
#rutas para formar los data tables
Route::get('/table/eventos', 'App\Http\Controllers\Records\RecordsController@tableeventos')->name('table.eventos');
Route::get('/table/pubs', 'App\Http\Controllers\Records\RecordsController@tablepublicaciones')->name('table.pubs');
#rutas pára los editar la información de los modales
Route::get('/edit/eventos', 'App\Http\Controllers\Records\RecordsController@editeventos')->name('edit.eventos');
Route::get('/edit/publicaciones', 'App\Http\Controllers\Records\RecordsController@editPublicaciones')->name('edit.publicaciones');

#RUTAS PARA EL SELEC2 HE INSERCIÓN DE POST
Route::post('/all/animals', 'App\Http\Controllers\Records\RecordsController@getAnimals')->name('all.animals');
Route::post('/insert/post', 'App\Http\Controllers\Publicaciones\PublicacionesController@inserPost')->name('insert.post');

