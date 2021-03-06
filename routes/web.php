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

    //View in which people can register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register'); 

    //Script that store the person data into the database
    Route::post('register', 'Auth\RegisterController@registerClient');

}

//View in which system notify user that must verify the email
Route::get('account_dont_verified', 'Auth\RegisterController@showDontVerifiedAccountView')->name('account_dont_verified');

if ($options['reset'] ?? true) {

    //View in which people enter an email to restore the haipay password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password_reset');
}

//Script that send the email with the link to change the haipay password
Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetPasswordEmail')->name('send_recover_email');

//View in which user access from the link sended to the email
Route::get('password/recover/{token}', 'Auth\ForgotPasswordController@showViewRestorePassword')->name('restore_password_view');

//Script that change the haipay password
Route::post('password/recover', 'Auth\ForgotPasswordController@restorePassword')->name('restore_password');

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
    
    //view in which user select how much of a crypto is going to buy (with)
    Route::get('deposit_crypto/{crypto}', 'ClientesController@depositCrypto')->name('deposit_crypto');
    
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
    
    //Script to verify a client verification image
    Route::post('verify_client_image', 'PersonasController@verifyClientImage')->middleware('auth')->name('verify_client_image');

    //View in which client can modify their personal info
    Route::get('edit_profile', 'PersonasController@showViewEditProfile')->middleware('auth')->name('edit_profile');
   
    //View in which clients can list remittances that other people have made them
    Route::get('my_remittances', 'ClientesController@showMyRemittancesView')->middleware('auth')->name('my_remittances');
    
    //Script that save a client's deposit
    Route::post('send_deposit', 'DepositosController@saveDeposit')->name('send_deposit');
   
    //View in which clients can list deposits they have made
    Route::get('my_deposits', 'DepositosController@listClientDeposits')->name('my_deposits');
    
});

//Moderator
Route::group(['middleware' => ['tipo:2']], function() {
    

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

    //View in which moderators list the clients whom they must verify
    Route::get('clients', 'ClientesController@showViewClients')->name('clients');

    //View in which moderator can see clients verification images and approve/refuse
    Route::get('clients/verify_images/{id}', 'ClientesController@verifyImages')->name('watch_client_images');

    //View in which moderator can see clients verification images and approve/refuse
    Route::get('mod_deposits', 'DepositosController@listModDeposits')->name('mod_deposits');

    //Script in which moderators complete deposits
    Route::post('verify_deposit', 'DepositosController@verifyDeposit')->name('verify_deposit');

    //Script in which moderators complete deposits
    Route::post('deliver_remittance', 'RemesasController@deliverRemittance')->name('deliver_remittance');
    
});

Route::post('acquireCripto', 'CriptomonedasController@acquireCripto')->name('acquireCripto');

//Moderator and Admin
Route::group(['middleware' => ['tipo:2,3']], function() {

    Route::post('change_state_remittance', 'RemesasController@changeStateRemittance')->name('change_state_remittance');
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

    Route::get('root_withdrawals', 'RetirosController@rootWithdrawal')->middleware('auth')->name('root_withdrawals');

    Route::post('change_minimum_to_withdraw', 'RetirosController@changeMinimumToWithdraw')->middleware('auth')->name('change_minimum_to_withdraw');

});

Route::post('save_profile', 'PersonasController@saveProfile')->middleware('auth')->name('save_profile');

//Client verify it's own account with email verification link
Route::get('verify_accounts/{code}', 'ClientesController@verifyAccount')->name('verify_accounts');

Route::get('logout', 'Auth\LoginController@logout')->name('logout');










//////////////////////////////////////////////////////////////////////////////
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
Route::get('watch_video', 'VideosController@showViewWatchVideo')->name('watch_video');



Route::get('consultar_persona_por_cedula','PersonasController@consultarPorCedula')->name('consultar_persona_por_cedula');
