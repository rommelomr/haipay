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
//Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');//Listo (5)
Route::post('login', 'Auth\LoginController@login');

if ($options['register'] ?? true) {

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');//Listo (1)
    Route::post('register', 'Auth\RegisterController@registerClient');

}
if ($options['reset'] ?? true) {
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');//Listo (4)
}
Route::get('password/recover/{token}', 'Auth\ForgotPasswordController@showViewResetPassword')->name('verification.notice');//Listo

Route::get('account_dont_verified', 'Auth\LoginController@showViewAccountDontVerified');//Listo


//Dashboard
Route::group(['middleware' => ['tipo:1']], function() {
	Route::get('dashboard_clients', 'ClientesController@showDashboard')->name('dashboard_clients');//Listo
});

//Users
Route::group(['middleware' => ['tipo:3']], function() {
	Route::get('users', 'UsersController@showViewUsers')->middleware('auth')->name('users');//Listo
});

Route::get('edit_profile', 'PersonasController@showViewEditProfile')->middleware('auth')->name('edit_profile');//Listo
Route::post('save_profile', 'PersonasController@saveProfile')->middleware('auth')->name('save_profile');//Listo

Route::post('create_user','UsersController@create_user');
Route::get('search_user','UsersController@search_user');
Route::get('search_user/{cedula}','UsersController@search_user');
Route::post('changeState','UsersController@changeState');
Route::post('modifyUser','UsersController@modifyUser');
Route::get('search_client','ClientesController@search_client');
Route::get('search_client/{cedula}','ClientesController@search_client');
Route::post('modify_client','ClientesController@modify_client');

Route::get('disabled_users', 'UsersController@showViewDisabledUsers');
Route::get('clients', 'ClientesController@showViewClients')->name('clients');;//Listo
Route::get('watch_video', 'VideosController@showViewWatchVideo')->name('watch_video');//Listo

//Transactions
Route::get('transactions', 'TransaccionesController@showViewTransactions')->name('transactions');//Listo
Route::get('transactions/{id_user}', 'TransaccionesController@showViewTransactions');//Listo

Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//Users
//Route::get('users', 'UsersController@showViewUsers');//Listo

/*


// Registration Routes...

// Password Reset Routes...
if ($options['reset'] ?? true) {
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    //Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
}

// Email Verification Routes...

if ($options['verify'] ?? false) {
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
}

Route::get('/home', 'HomeController@index')->name('home');
*/


Route::post('acquireCripto', 'ClientesController@acquireCripto')->name('acquireCripto');//Listo