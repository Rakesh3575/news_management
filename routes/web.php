<?php 

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
     Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
     
    Route::post('/login/admin', 'Auth\LoginController@adminLogin');
    Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
     
    Route::view('/home', 'home')->middleware('auth');
    Route::view('/admin', 'admin');
 

 
    Route::group(['middleware'=>'auth'],function(){
        Route::resource('News','NewsController');
         Route::post('/like','NewsController@newsLike')->name('like');
 Route::resource('category', 'CategoryController');
     });
  
    Route::group(['prefix'=>'admin','middleware' => 'auth:admin'], function () {
    //Route::resource('News','Admin\NewsController');
    Route::get('News','Admin\NewsController@index')->name('News.index'); 
    Route::match(['get','post'],'/News/status/{id}','Admin\NewsController@changestatus')->name('News.changestatus');
    });

    Route::get('get-state-list','Auth\RegisterController@getStateList');

 