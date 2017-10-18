<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

/*Route::group(['prefix' => 'admin'], function(){

	Route::resource('users','UsersController'); //Primer parametro la url, segundo el controlador
	Route::get('/users/destroy/{id}', [

		'uses' 	=> 'UsersController@destroy',
		'as'	=> 'users.destroy'

	]);

});*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file/all', 'NotificationController@show');

Auth::routes();

Route::resource('files','FilesController');

Route::get('/files/destroy/{id}', [

        'uses'  => 'FilesController@destroy',
        'as'    => 'files.destroy'

]);

Route::get('/file/all','NotificationController@show')->name('allfiles');

Route::resource('users','UsersController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('formulario', 'StorageController@index');

Route::post('/storage/create', 'StorageController@store')->name("uploadfiles");

Route::get('storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);
});
Route::get('/filesadmin','FilesController@index2');
Route::get('folder/{id}', 'NotificationController@showFolder')->name("moveToFolder")->middleware('auth');

Route::get('shared/files', 'NotificationController@showShared')->name("showShared");

Route::post('files/shared', 'NotificationController@shardWith')->name("sharedWith");