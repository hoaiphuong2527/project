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
    
    //Book
    Route::get('/books',
                ['as' => 'books.index', 
                'uses' =>'BookController@index']);
    Route::get('/books/create', [
                'as' => 'books.create',
                'uses' => 'BookController@create'
                ]);
    Route::post('books/create',
                ['as' => 'books.create.post', 
                'uses' => 'BookController@postCreate'
                ]);
    Route::get('books/edit',
                ['as' => 'books.create.edit', 
                'uses' => 'BookController@getEdit'
                ]);
    Route::post('books/edit',
                ['as' => 'books.create.post', 
                'uses' => 'BookController@update'
                ]);
    Route::get('/books/delete/{id}' ,
                ['as' => 'books.delete',
                'uses' => 'BookController@destroy'
                ]);
    Route::get('/books/detail' ,
                ['as' => 'books.detail',
                'uses' => 'BookController@detail'
                ]);
    //categories
    Route::get('/categories',
                ['as' =>'categories.index',
                'uses'=>'CategoryController@index'
                ]);
    Route::get('/categories/create',
                ['as' =>'categories.create',
                'uses'=>'CategoryController@create'
                ]);
    Route::post('/categories/create',
                ['as' =>'categories.create.post',
                'uses'=>'CategoryController@postCreate'
                ]);
    Route::get('/categories/edit',
                ['as' =>'categories.edit',
                'uses'=>'CategoryController@edit'
                ]);
    Route::post('/categories/edit',
                ['as' =>'categories.edit.post',
                'uses'=>'CategoryController@update'
                ]);
    Route::get('/categories/delete/{id}',
                ['as' =>'categories.delete',
                'uses'=>'CategoryController@detroys'
                ]);

    //book_copy
    Route::get('/provide',
                ['as' => 'provide.index', 
                'uses' => 'BookCopyController@index'
                ]);   
    Route::post('/provide',
                ['as' => 'provide.update', 
                'uses' => 'BookCopyController@update'
                ]);              
});