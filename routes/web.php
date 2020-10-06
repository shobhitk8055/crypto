<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/b', 'BubbleController@index')->name('b');
//For Views
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'ProfileController@dashboard')->name('dashboard');
Route::get('/profile', 'ProfileController@show')->name('profile');
Route::get('/profile/{id}', 'ProfileController@profile')->name('user.profile');
Route::get('/add-funds', 'FundsController@show')->name('funds.add');
Route::get('/transferfunds', 'TransferController@show')->name('funds.transfer');
Route::get('/orderbook', 'OrderBookController@index')->name('funds');
Route::get('/tradehistory', 'TradeHistoryController@index')->name('funds');
Route::get('/myorders', 'MyOrdersController@index')->name('funds');
Route::get('/withdraw', 'WithdrawController@index')->name('withdraw');
Route::get('/add_accounts', 'AccountsController@index')->name('add_accounts');
Route::get('/topup', 'TransferController@index')->name('topup');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/depositfunds', 'DepositController@show')->name('deposit');
Route::get('/p2p', 'P2PController@show')->name('p2p');
Route::get('/p2p/show', 'P2PController@showCreateForm')->name('p2p.showCreateForm');
Route::get('/p2p/transactions', 'P2PController@transactions')->name('p2p.transactions');
Route::get('/p2p/approved', 'P2PController@approved')->name('p2p.approved');
Route::get('/p2p/{order_id}', 'P2PController@showOrder')->name('p2p.showOrder');
Route::get('/trading', 'TradingController@index')->name('trading');
Route::get('/details', 'DetailsController@index')->name('details');
Route::get('/team', 'TeamController@index')->name('team');
Route::get('/directs', 'TeamController@directs')->name('directs');
Route::get('/levelTeam', 'TeamController@levelTeam')->name('levelTeam');


//For DB
Route::patch('/profile/edit','ProfileController@update')->name('profile.update');
Route::post('/dashboard/buy', 'OrdersController@store')->name('buy');
Route::post('/dashboard/sell', 'OrdersController@sell')->name('sell');
Route::patch('/orders/edit', 'OrdersController@update')->name('orders.update');
Route::patch('/changepassword', 'UpdatePassword@update')->name('profile.update');
Route::post('/add-funds/add', 'FundsController@store')->name('profile.store');
Route::post('/tranferfunds', 'TransferController@store')->name('funds');
Route::post('/topup', 'TransferController@topup')->name('topup.store');
Route::post('/add_account/create', 'AccountsController@store')->name('account.create');
Route::post('/withdraw/create', 'WithdrawController@store')->name('withdraw.create');
Route::post('/deposit/create', 'DepositController@store')->name('deposit.create');
Route::post('/p2p/create', 'P2PController@create')->name('p2p.create');
Route::post('/p2p/transaction', 'P2PController@store')->name('p2p.store');
Route::post('/p2p/received', 'P2PController@received')->name('p2p.received');
Route::post('/p2p/sent', 'P2PController@sent')->name('p2p.sent');
Route::post('/ordersCompleter/{id}', 'OrdersController@ordersCompleter')->name('ordersCompleter');

//For Admin view
Route::prefix('admin')->group(function(){
    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/login', 'admin\LoginController@showLoginForm')->name('admin.login');
    Route::get('/logout', 'admin\LoginController@logout')->name('admin.logout');
    Route::get('/users', 'AdminUsersConroller@index')->name('admin.users');
    Route::get('/users/search', 'AdminUsersConroller@search')->name('admin.users.search');
    Route::get('/users/{id}', 'AdminProfileController@index')->name('admin.profile');
    Route::get('/users/destroy/{id}', 'AdminProfileController@destroy')->name('admin.profile.destroy');
    Route::get('/investment', 'InvestmentController@index')->name('investment');
    Route::get('/approvedwithdrawal', 'AdminWithdrawalController@index')->name('approvedWithdrawal');
    Route::get('/pendingwithdrawal', 'AdminWithdrawalController@show')->name('pendingWithdrawal');
    Route::get('/approve/{id}', 'AdminWithdrawalController@update')->name('approve');
    Route::get('/topup', 'TopupController@index')->name('admin.topup');
    Route::get('/rate', 'RateController@index')->name('rate');
    Route::get('/deposit', 'AdminDepositController@show')->name('admin.pendingDeposit');
    Route::get('/approved/deposit', 'AdminDepositController@approvedShow')->name('admin.approvedDeposit');
    Route::get('/addFunds', 'AdminFundsController@index')->name('admin.funds');
    Route::get('/dailypst', 'AdminDailyPSTController@index')->name('admin.dailypst');

//For Admin DB
    Route::post('/login', 'admin\LoginController@login')->name('admin.login.submit');
    Route::post('/topup', 'TopupController@topup')->name('topup.create');
    Route::post('/user/update/{id}', 'AdminProfileController@update')->name('admin.profile.update');
    Route::patch('/updatepassword/{id}', 'AdminProfileController@password')->name('admin.password.update');
    Route::post('/rate', 'RateController@update')->name('rate.update');
    Route::post('/deposit/update', 'AdminDepositController@update')->name('admin.deposit.update');
    Route::post('/addFunds', 'AdminFundsController@pstUpdate')->name('admin.funds.create');
    Route::post('/addFundsUsdt', 'AdminFundsController@usdtUpdate')->name('admin.funds.usdt');
    Route::post('/dailypst/update', 'AdminDailyPSTController@update')->name('admin.dailypst.update');

});
