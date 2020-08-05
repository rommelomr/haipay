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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

if ($options['register'] ?? true) {

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register'); 
    Route::post('register', 'Auth\RegisterController@registerClient');

}
if ($options['reset'] ?? true) {
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
}
Route::get('password/recover/{token}', 'Auth\ForgotPasswordController@showViewResetPassword')->name('verification.notice');

Route::get('account_dont_verified', 'Auth\LoginController@showViewAccountDontVerified');



//Clients
Route::group(['middleware' => ['tipo:1']], function() {

    //verify Payments views
    Route::get('payments/verify','ClientesController@verifyPyments')->name('verify_payments');

    Route::get('payments/canceled','ClientesController@canceledPyments')->name('canceled_payments');

    Route::get('payments/waiting','ClientesController@waitingPyments')->name('waiting_payments');
    
    Route::get('payments/approved','ClientesController@approvedPyments')->name('approved_payments');
    
    //view in which user can see the crypto's price
    Route::get('dashboard_clients', 'ClientesController@showDashboard')->name('dashboard_clients');
    
	//view in which user select how much of a crypto is going to buy
    Route::get('buy_crypto/{crypto}', 'ClientesController@buyCripto')->name('buy_crypto');
    
    //Script to make the buy
    Route::post('buy_crypto', 'ComprasCriptomonedaController@buyCripto')->name('buy_crypto_post');

    //View in which system display a message indicating to the user has to verify the payments
    Route::get('pursache_notice', 'ComprasCriptomonedaController@pursacheNotice')->name('pursache_notice');

    //view in which user see the remittances waiting for an admin approve
    Route::get('withdraw/{siglas}', 'RetirosController@showWithdrawalsView')->name('withdraw');    

    //view in which user see the remittances waiting for an admin approve
    Route::post('withdraw', 'RetirosController@withdraw')->name('withdraw_post');    

    //view in which user choose the second crypto of the pair to change
    Route::get('trade/{crypto}', 'ClientesController@trade')->name('trade');

    //view in which user set how much crypto is going to change
    Route::get('setTrade/{pair}', 'ClientesController@setTrade')->name('setTrade');

    //Script to make the trade
    Route::post('make_trade', 'ComprasCriptomonedaController@makeTrade')->name('make_trade');

    //Script to save the picture that user upload to verify his transactions (pursaches and trading)
    Route::post('verify_transaction', 'ImagenesTransaccionController@verifyPyment')->middleware('auth')->name('verify_transaction');
    
    //view in which user see the form to send money, history of remittances made and consult it's remittances
    Route::get('remittances', 'RemesasController@showRemittancesView')->name('remittances');

    //View in which the user confirm the remittance just made
    Route::post('confirm_remittance','RemesasController@confirmarRemesa')->name('confirmar_remesa');

    //Script to register the remittances that users made
    Route::post('enviar_remesa','RemesasController@enviarRemesa')->name('enviar_remesa');

    //Script to change the transactions image
    Route::post('resend_image', 'ImagenesTransaccionController@resendImage')->middleware('auth')->name('resend_image');
    
    //view in which user see the remittances that has to verify
    Route::get('remittances/verify', 'RemesasController@verifyRemittances')->name('verify_remittances');
    
    //view in which user see the approved remittances
    Route::get('remittances/approved', 'RemesasController@approvedRemittances')->name('approved_remittances');
    
    //view in which user see the remittances waiting for an admin approve
    Route::get('remittances/waiting', 'RemesasController@waitingRemittances')->name('waiting_remittances');

    //view in which user see the remittances canceled for an admin
    Route::get('remittances/canceled', 'RemesasController@canceledRemittances')->name('canceled_remittances');
    
    //Script
    Route::post('update_adress', 'ClientesController@updateAdress')->name('update_adress');

    //view in which user see the remittances waiting for an admin approve
    Route::post('update_tag', 'ClientesController@updateTag')->name('update_tag');
    

});

//Moderator
Route::group(['middleware' => ['tipo:2']], function() {
    //Client verify it's own account
    Route::get('verify_accounts', 'ClientesController@verifyAccounts')->middleware('auth')->name('verify_accounts');

    //Moderator verify client's account
    Route::post('verify_image_moderator', 'ImagenesVerificacionController@verifyImage')->middleware('auth')->name('verify_image_moderator');

    //View in which moderators list their transactions for verify
    Route::get('transactions', 'TransaccionesController@showViewTransactions')->name('transactions');

    //View in which moderators list their transactions for verify and a transaction selected
    Route::get('transactions/{id}', 'TransaccionesController@seeTransaction');

    //View in which moderators list all retirements they have to send
    Route::get('withdrawals', 'RetirosController@withdrawals')->name('withdrawals');

    //View in which moderators list all retirements they have to send
    Route::get('withdrawals/{id_retiro}', 'RetirosController@seeWithdraw')->name('see_withdrawal');

    //Script in which moderators complete the withdrawals
    Route::post('complete_withdraw', 'RetirosController@completeWithdraw')->name('complete_withdraw');
    
});

Route::post('acquireCripto', 'CriptomonedasController@acquireCripto')->name('acquireCripto');

//Moderator and Admin
Route::group(['middleware' => ['tipo:2,3']], function() {

    Route::get('change_state_remittance', 'RemesasController@chageState')->name('change_state_remittance');
    Route::get('see_remittance/{id}', 'RemesasController@seeRemittance')->name('see_remittance');
    Route::get('all_remittances', 'RemesasController@showAllRemittancesView')->name('all_remittances');
    Route::get('search_remittances', 'RemesasController@searchRemittances')->name('search_remittances');

    //Script to an admin or moderator verify or cancel the transaction's image of a client
    Route::post('change_state_transaction', 'TransaccionesController@changeStateTransaction')->name('change_state_transaction');
});

//Admin
Route::group(['middleware' => ['tipo:3']], function() {

    //View in which admin consult users, moderators and other admins
	Route::get('users', 'UsersController@showViewUsers')->middleware('auth')->name('users');

    //View in which admin can modify all the comissions
    Route::get('comissions', 'ComisionesController@showComissionsView')->middleware('auth')->name('comissions');
    
    Route::post('update_comission', 'ComisionesController@updateComission')->middleware('auth')->name('update_comission');

    Route::post('update_network_comission', 'ComisionesController@updateNetworkComission')->middleware('auth')->name('update_network_comission');

});


Route::get('edit_profile', 'PersonasController@showViewEditProfile')->middleware('auth')->name('edit_profile');
Route::post('save_profile', 'PersonasController@saveProfile')->middleware('auth')->name('save_profile');
Route::post('file_Verify', 'PersonasController@file_Verify')->middleware('auth')->name('file_Verify');

Route::post('create_user','UsersController@create_user')->name('create_user');
Route::get('search_user','UsersController@searchUser')->name('search_user');
Route::get('search_user/{id}','UsersController@seeUser')->name('see_user');
Route::post('edit_user','UsersController@editUser')->name('edit_user');

Route::post('change_state','UsersController@changeState')->name('change_state');
Route::post('modifyUser','UsersController@modifyUser');
//Route::get('search_client','ClientesController@search_client')->name('search_client');
Route::get('search_clients','ClientesController@searchClients')->name('search_clients');
Route::get('clients/{cedula}','ClientesController@searchClient');
Route::post('modify_client','ClientesController@modify_client');

Route::get('disabled_users', 'UsersController@showViewDisabledUsers');
Route::get('clients', 'ClientesController@showViewClients')->name('clients');;
Route::get('watch_video', 'VideosController@showViewWatchVideo')->name('watch_video');


Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('consultar_persona_por_cedula','PersonasController@consultarPorCedula')->name('consultar_persona_por_cedula');
