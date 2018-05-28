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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/login', ['as'=> 'login',function(){
    return view('auth.login');
}]);
Route::group(['prefix' => '/','middleware' => 'admin'],function(){
    Route::get('/home', 'HomeController@index')->name('home');

    //user
    Route::get('/users','UserController@index');
    Route::get('/users/create', [
                'as' => 'user.create',
                'uses' => 'UserController@getCreate'
                ]);
    Route::post('/users/create', [
                'as' => 'user.create.post', 
                'uses' => 'UserController@postCreate' 
                ]);
    Route::get('/users/edit' ,
                ['as' => 'user.edit',
                'uses' => 'UserController@getEdit'
                ]);
    Route::post('/users/edit' ,
                ['as' => 'user.edit.post',
                'uses' => 'UserController@postEdit'
                ]);
    Route::get('/users/delete/{id}' ,
                ['as' => 'user.delete',
                'uses' => 'UserController@delete'
                ]);
    Route::get('/users/detail' ,
                ['as' => 'user.detail',
                'uses' => 'UserController@detail'
                ]);
    
});