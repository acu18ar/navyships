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
    return view('login');
})->name('login');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/Error/{mensaje}',function($mensaje) {
    return $mensaje;
})->name('error');

//login
Route::post('/enter/system','UserController@doLogin')->name('enter.system');

Route::middleware('checkAuth')->group(function () {
    //acciones
    Route::get('/acciones/index','AccionController@index')->name('acciones.index');
    Route::get('/accion/edit/{role}','AccionController@edit')->name('accion.edit');

    //uers
    Route::get('/users/index','UserController@index')->name('users.index');
    Route::get('/user/create','UserController@create')->name('user.create');
    Route::get('/user/create/regional/{user}','UserController@createRegional')->name('user.create.regional');
    Route::get('/user/edit/{user}','UserController@edit')->name('user.edit');

    Route::post('/user/store','UserController@store')->name('user.store');
    Route::put('/user/update/{user}','UserController@update')->name('user.update');
    Route::delete('/user/delete/{user}','UserController@destroy')->name('user.delete');

    //localidades
    Route::get('/locations/index','LocalidadController@index')->name('localidades.index');
    Route::get('/location/create','LocalidadController@create')->name('localidad.create');
    Route::get('/location/edit/{localidad}','LocalidadController@edit')->name('localidad.edit');

    Route::post('/location/store','LocalidadController@store')->name('localidad.store');
    Route::put('/location/update/{localidad}','LocalidadController@update')->name('localidad.update');
    Route::delete('/location/delete/{localidad}','LocalidadController@destroy')->name('localidad.delete');

    //Localidades_User
    Route::post('/location/user/store','UserController@localidadUserStore')->name('localidad.user.store');

    //Buques
    Route::get('/buques/index','ShipController@index')->name('buques.index');
    Route::get('/buque/create','ShipController@create')->name('buque.create');
    Route::get('/buque/edit/{buque}','ShipController@edit')->name('buque.edit');
    Route::get('/buque/view/{buque}','ShipController@view')->name('buque.view');

    Route::get('/api/buque/getDates/{buque}','ShipController@getDates')->name('buque.dates');

    Route::post('/buque/store','ShipController@store')->name('buque.store');
    Route::put('/buque/update/{buque}','ShipController@update')->name('buque.update');
    Route::delete('/buque/delete/{buque}','ShipController@destroy')->name('buque.delete');

    //Tripulacion
    Route::get('/tripulacion/index','TripulacionController@index')->name('tripulacion.index');
    Route::get('/tripulacion/create','TripulacionController@create')->name('tripulacion.create');
    Route::get('/tripulacion/edit/{tripulacion}','TripulacionController@edit')->name('tripulacion.edit');

    Route::post('/tripulacion/store','TripulacionController@store')->name('tripulacion.store');
    Route::put('/tripulacion/update/{tripulacion}','TripulacionController@update')->name('tripulacion.update');
    Route::delete('/tripulacion/delete/{tripulacion}','TripulacionController@destroy')->name('tripulacion.delete');

    //Trackers
    Route::get('/tracker/index','TrackerController@index')->name('trackers.index');
    Route::get('/tracker/create','TrackerController@create')->name('tracker.create');
    Route::get('/tracker/edit/{tracker}','TrackerController@edit')->name('tracker.edit');

    Route::post('/tracker/store','TrackerController@store')->name('tracker.store');
    Route::put('/tracker/update/{tracker}','TrackerController@update')->name('tracker.update');
    Route::delete('/tracker/delete/{tracker}','TrackerController@destroy')->name('tracker.delete');
});

Route::get('/api/storePosition/clean/{data}','PosicionController@store');//API
Route::get('/api/storePosition/{id}/{lat}/{lon}','PosicionController@store2');//API