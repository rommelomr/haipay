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

Route::get('/', 'UsersController@main')->middleware('auth')->name('/');
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
    //Client verify a payment
    Route::post('verify_transaction', 'ImagenesTransaccionController@verifyPyment')->middleware('auth')->name('verify_transaction');//Listo

    //Client resend an image
    Route::post('resend_image', 'ImagenesTransaccionController@resendImage')->middleware('auth')->name('resend_image');//Listo
    Route::post('delete_transaction', 'RemesasController@eliminarTransaccion')->middleware('auth')->name('delete_transaction');//Listo
});

//Dashboard
Route::group(['middleware' => ['tipo:2']], function() {
    //Client verify it's own account
    Route::get('verify_accounts', 'ClientesController@verifyAccounts')->middleware('auth')->name('verify_accounts');

    //Moderator verify client's account
    Route::post('verify_image_moderator', 'ImagenesVerificacionController@verifyImage')->middleware('auth')->name('verify_image_moderator');

});

Route::post('acquireCripto', 'CriptomonedasController@acquireCripto')->name('acquireCripto');//Listo


//Users
Route::group(['middleware' => ['tipo:3']], function() {
	Route::get('users', 'UsersController@showViewUsers')->middleware('auth')->name('users');//Listo
});

Route::get('edit_profile', 'PersonasController@showViewEditProfile')->middleware('auth')->name('edit_profile');//Listo
Route::post('save_profile', 'PersonasController@saveProfile')->middleware('auth')->name('save_profile');//Listo
Route::post('file_Verify', 'PersonasController@file_Verify')->middleware('auth')->name('file_Verify');//Listo

Route::post('create_user','UsersController@create_user');
Route::get('search_user','UsersController@search_user');

Route::get('search_user/{cedula}','UsersController@search_user');//??????????

Route::post('change_state','UsersController@changeState')->name('change_state');
Route::post('modifyUser','UsersController@modifyUser');
//Route::get('search_client','ClientesController@search_client')->name('search_client');
Route::get('search_clients','ClientesController@searchClients')->name('search_clients');
Route::get('clients/{cedula}','ClientesController@searchClient');
Route::post('modify_client','ClientesController@modify_client');

Route::get('disabled_users', 'UsersController@showViewDisabledUsers');
Route::get('clients', 'ClientesController@showViewClients')->name('clients');;//Listo
Route::get('watch_video', 'VideosController@showViewWatchVideo')->name('watch_video');//Listo

//Transactions
Route::get('transactions', 'TransaccionesController@showViewTransactions')->name('transactions');//Listo
Route::get('transactions/{id_user}', 'TransaccionesController@showViewTransactions');//Listo

Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Remesas
Route::post('enviarRemesas','RemesasController@enviarRemesas');

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

