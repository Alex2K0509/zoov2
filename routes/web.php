<?php

use Illuminate\Support\Facades\Route;
use App\Models\TOKENS\TOKen;
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

Route::post('/notification/post', 'App\Http\Controllers\Records\RecordsController@sentNofiticationPost')->name('noti.posts');
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');


//Auth::routes();
Auth::routes(["register" => false]);
Route::group(['middleware' => ['auth','userable']], function () {

    Route::get('/home', 'App\Http\Controllers\RECORDS\RecordsController@tableeventos')->name('home');
    Route::get('/home', 'App\Http\Controllers\RECORDS\RecordsController@tableeventos')->name('home');

    Route::get('user', 'App\Http\Controllers\UserController@index')->name('user.index'); #pagina inicial
    Route::get('admin', 'App\Http\Controllers\UserController@admin')->name('user.admin'); #pagina inicial

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']); #perfil del usuario

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
    Route::get('map', function () {
        return view('pages.maps');
    })->name('map');
    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');
    Route::get('table-list', function () {
        return view('pages.tables');
    })->name('table');

    #ruta para insertar eventos
    Route::post('/evento/add', 'App\Http\Controllers\CATALOGOS\CatalogosController@InserEvent')->name('eventoInsert');
    Route::post('/animal/add', 'App\Http\Controllers\CATALOGOS\CatalogosController@InsertAnimal')->name('InsertAnimal');
    #ruta para editar un evento
    #Route::get('/edit/evento', 'App\Http\Controllers\CATALOGOS\RecordsController@editEventos')->name('edit.eventos');

    #rutas para formar los data tables
    Route::get('/table/eventos', 'App\Http\Controllers\RECORDS\RecordsController@tableeventos')->name('table.eventos');
    Route::get('/table/pubs', 'App\Http\Controllers\RECORDS\RecordsController@tablepublicaciones')->name('table.pubs');
    Route::get('/table/animals', 'App\Http\Controllers\RECORDS\RecordsController@tableAnimales')->name('table.animals');
    #rutas pára los visualizar la información del evento o publicación desde el modal de editar
    Route::get('/info/eventos', 'App\Http\Controllers\RECORDS\RecordsController@infoediteve')->name('info.eventos');
    Route::get('/info/publicaciones', 'App\Http\Controllers\RECORDS\RecordsController@infoPublications')->name('info.publicaciones');
    Route::get('/info/animals', 'App\Http\Controllers\RECORDS\RecordsController@infoAnimals')->name('info.animals');
    #rutas para editar un evento o publicación desde el modal de editar
    Route::post('/edit/eventos', 'App\Http\Controllers\RECORDS\RecordsController@editeventos')->name('edit.eventos');
    Route::post('/edit/pubs', 'App\Http\Controllers\RECORDS\RecordsController@editpubs')->name('edit.pubs');
    Route::post('/edit/animals', 'App\Http\Controllers\RECORDS\RecordsController@editanimals')->name('edit.animals');
    #rutas para eliminar un evento del datatable de eventos
    Route::delete('delete/evento', 'App\Http\Controllers\RECORDS\RecordsController@deleteEvento')->name('delete.eventos');
    Route::delete('delete/pub', 'App\Http\Controllers\RECORDS\RecordsController@deletePub')->name('delete.pub');
    Route::delete('delete/animals', 'App\Http\Controllers\RECORDS\RecordsController@deleteAnimals')->name('delete.animals');
    #RUTAS PARA EL SELEC2 HE INSERCIÓN DE POST
    Route::post('/all/animals', 'App\Http\Controllers\RECORDS\RecordsController@getAnimals')->name('all.animals');
    Route::post('/insert/post', 'App\Http\Controllers\PUBLICACIONES\PublicacionesController@inserPost')->name('insert.post');
    #RUTAS PARA ENVIAR NOTIFICACIONES DE LOS EVENTOS Y PUBLICACIONES
    Route::post('/notification/eventos', 'App\Http\Controllers\RECORDS\RecordsController@sentNofitication')->name('noti.eventos');
    Route::post('/notification/post', 'App\Http\Controllers\RECORDS\RecordsController@sentNofiticationPost')->name('noti.posts');
    #RUTAS PARA EDITAR LA IMAGEN DE PERFIL
    Route::post('/profile/edit/pic', 'App\Http\Controllers\ProfileController@editPic')->name('edit.pic');


    Route::get('/report/event/pdf', 'App\Http\Controllers\REPORTES_PDF\REPOcontroller@createEventReport');
    Route::get('/report/post/pdf', 'App\Http\Controllers\REPORTES_PDF\REPOcontroller@createPostReport');
    Route::get('/report/animal/pdf', 'App\Http\Controllers\REPORTES_PDF\REPOcontroller@createAnimalReport');
    Route::post('profile/info', 'App\Http\Controllers\ProfileController@update'); #actualizar info
    Route::post('profile/password',  'App\Http\Controllers\ProfileController@password');

    Route::post('/create/admin',  'App\Http\Controllers\UserController@createAdmin');
    Route::get('/table/admin',  'App\Http\Controllers\UserController@tableAdmin');
    Route::get('/info/Admin',  'App\Http\Controllers\UserController@infoAdmin');
    Route::post('/edit/Admin',  'App\Http\Controllers\UserController@editAdmin');

});
