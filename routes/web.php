<?php

// MicropostsController@index ) を経由してwelcomeを表示する
Route::get('/', 'TasksController@index');

// RegisterController => RegistersUsersの中にshowRegistrationForm()が定義されており，中には return view('auth.register'); の1行だけが記述されている
// つまり，showRegistrationForm() アクションは、ただ単に resources/views/auth/register.blade.php を表示するアクション
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');

// register.blade.phpから送られてきた情報を「RegisterController」の「registerメソッド」につなげる
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');



// LoginController => AuthenticatesUsersの中にshowLoginForm()が定義されており，中には return view('auth.login'); の1行だけが記述されている
// つまり，showLoginForm() アクションは、ただ単に resources/views/auth/login.blade.php を表示するアクション
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

// ブラウザから送られてきた情報を「LoginController」の「loginメソッド」につなげる
Route::post('login', 'Auth\LoginController@login')->name('login.post');

// ブラウザから送られてきた情報を「LoginController」の「logoutメソッド」につなげる
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');



// Route::group() でルートのグループを作り、 auth ミドルウェアを指定することで、このグループ内のルートへアクセスする際に、ログインを必要とするようにできる。
// もちろんコントローラ側でコンストラクタ指定も可能である
Route::group(['middleware' => ['auth']], function () {
    //  ['only' => ['index', 'show']] は作成されるルートを絞り込んでいる　→　indexとshowだけでいい（7つ全てはいらない）
    // Route::get('users/{id}/drop', 'UsersController@drop')->name('users.drop');
    Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'update', 'edit', 'destroy']]);
    Route::resource('tasks', 'TasksController');
});