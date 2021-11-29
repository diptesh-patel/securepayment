<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\MerchantController as AdminMerchant;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\MidController as AdminMid;
use App\Http\Controllers\Admin\OrderController as AdminOrder;
use App\Http\Controllers\Admin\TokenController as AdminToken;
use App\Http\Controllers\Admin\PendingCashOutController as AdminPendingCashOut;
use App\Http\Controllers\Admin\SettingController as Adminsetting;

use App\Http\Controllers\Merchant\OrderController as MerchantOrder;
use App\Http\Controllers\Merchant\TokenController as MerchantToken;
use App\Http\Controllers\Merchant\KeyController as MerchantKey;
use App\Http\Controllers\Merchant\PlanController as MerchantPlans;
use App\Http\Controllers\Merchant\SettingController as Merchantsetting;
use App\Http\Controllers\Mid\PayretailerController as Payretailer;
use App\Http\Controllers\Mid\OpaywebController as Opayweb;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Auth::routes();

Route::get('/closemodal', [LoginController::class, 'closemodal'])->name('closemodal');
Route::post('/register', [RegisterController::class, 'submit_signup'])->name('register');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/***Admin user Route */
Route::get('admin/dashboard', [AdminDashboard::class, 'adminDashboard'])->name('admin.dashboard')->middleware('is_admin');
Route::get('admin/merchants', [AdminMerchant::class, 'merchantList'])->name('admin.merchants')->middleware('is_admin');
Route::get('admin/users', [AdminUser::class, 'userList'])->name('admin.users')->middleware('is_admin');
Route::get('admin/mids', [AdminMid::class, 'midList'])->name('admin.mids')->middleware('is_admin');
Route::get('admin/orders', [AdminOrder::class, 'ordersList'])->name('admin.orders')->middleware('is_admin');
Route::get('admin/token_transections', [AdminToken::class, 'tokenTransectionsList'])->name('admin.token_transections')->middleware('is_admin');
Route::get('admin/pending_cash_out', [AdminPendingCashOut::class, 'pendingCashOutList'])->name('admin.pending_cash_out')->middleware('is_admin');
Route::get('admin/settings', [Adminsetting::class, 'index'])->name('admin.settings')->middleware('is_admin');
/****
 * Admin Merchant Route
 * 
*/
Route::get('admin/merchants/add', [AdminMerchant::class, 'add'])->name('admin.add')->middleware('is_admin');
Route::post('admin/add_merchant', [AdminMerchant::class, 'add_merchant'])->name('admin.add_merchant')->middleware('is_admin');
Route::get('admin/merchants/edit/{id}', [AdminMerchant::class, 'edit'])->name('admin.edit')->middleware('is_admin');
Route::post('admin/update_merchant', [AdminMerchant::class, 'update_merchant'])->name('admin.update_merchant')->middleware('is_admin');

/****
 * Admin User Route
 * 
*/
Route::get('admin/users/add', [AdminUser::class, 'add'])->name('admin.add')->middleware('is_admin');
Route::post('admin/add_user', [AdminUser::class, 'add_user'])->name('admin.add_user')->middleware('is_admin');
Route::get('admin/users/edit/{id}', [AdminUser::class, 'edit'])->name('admin.useredit')->middleware('is_admin');
Route::get('admin/users/assign/{id}', [AdminUser::class, 'user_assign'])->name('admin.userassign')->middleware('is_admin');
Route::post('admin/assign_merchant', [AdminUser::class, 'assign_merchant'])->name('admin.assign_merchant')->middleware('is_admin');
Route::post('admin/update_user', [AdminUser::class, 'update_user'])->name('admin.update_user')->middleware('is_admin');
/****
 * Admin MID Route
 * 
*/
Route::get('admin/mids/add', [AdminMid::class, 'add'])->name('admin.mid_add')->middleware('is_admin');
Route::post('admin/add_mid', [AdminMid::class, 'add_mid'])->name('admin.add_mid')->middleware('is_admin');
Route::get('admin/mids/edit/{id}', [AdminMid::class, 'edit'])->name('admin.midedit')->middleware('is_admin');
Route::post('admin/update_mid', [AdminMid::class, 'update_mid'])->name('admin.update_mid')->middleware('is_admin');
Route::get('admin/testemail', [AdminMid::class, 'testemail'])->name('admin.testemail')->middleware('is_admin');

/***
 * Datatable URL
 * 
 */
Route::get('admin/getmerchantslist', [AdminMerchant::class, 'getmerchantslist'])->name('admin.getmerchantslist')->middleware('is_admin');
Route::get('admin/getuserslist', [AdminUser::class, 'getuserslist'])->name('admin.getuserslist')->middleware('is_admin');
Route::get('admin/getmidslist', [AdminMid::class, 'getmidslist'])->name('admin.getmidslist')->middleware('is_admin');
/***Merchant user Route */
Route::get('merchant/dashboard', [DashboardController::class, 'merchantDashboard'])->name('merchant.dashboard')->middleware('is_merchant');
Route::get('merchant/orders', [MerchantOrder::class, 'ordersList'])->name('merchant.orders')->middleware('is_merchant');
Route::get('merchant/token_transections', [MerchantToken::class, 'tokenTransectionsList'])->name('merchant.token_transections')->middleware('is_merchant');
Route::get('merchant/token_to_money', [MerchantToken::class, 'token_to_money'])->name('merchant.token_to_money')->middleware('is_merchant');
Route::get('merchant/access_key', [MerchantKey::class, 'access_key'])->name('merchant.access_key')->middleware('is_merchant');
Route::post('merchant/create_key', [MerchantKey::class, 'create_key'])->name('merchant.create_key')->middleware('is_merchant');
Route::post('merchant/remove_key', [MerchantKey::class, 'remove_key'])->name('merchant.remove_key')->middleware('is_merchant');
Route::get('merchant/plans', [MerchantPlans::class, 'plan_list'])->name('merchant.plan_list')->middleware('is_merchant');
Route::get('merchant/settings', [Merchantsetting::class, 'index'])->name('merchant.settings')->middleware('is_merchant');
Route::post('merchant/verifyGoogle2FAKey', [Merchantsetting::class, 'verifyGoogle2FAKey'])->name('merchant.verifyGoogle2FAKey')->middleware('is_merchant');
/***
 * 
 * Payretailer Route
 */
Route::post('payretailer/createNewPayoutBatch', [Payretailer::class, 'createNewPayoutBatch'])->name('payretailer.createNewPayoutBatch');
Route::post('payretailer/createNewPayout', [Payretailer::class, 'createNewPayout'])->name('payretailer.createNewPayout');
Route::get('payretailer/getPayoutBatchByID/{id}', [Payretailer::class, 'getPayoutBatchByID'])->name('payretailer.getPayoutBatchByID');
Route::get('payretailer/getPayoutByID/{id}', [Payretailer::class, 'getPayoutByID'])->name('payretailer.getPayoutByID');
Route::get('payretailer/getpaymentMethods', [Payretailer::class, 'getpaymentMethods'])->name('payretailer.getpaymentMethods');

Route::get('payretailer/createTransactions', [Payretailer::class, 'createTransactions'])->name('payretailer.createTransactions');
Route::get('payretailer/getTransactions', [Payretailer::class, 'getTransactions'])->name('payretailer.getTransactions');

Route::get('payretailer/getShopBalance', [Payretailer::class, 'getShopBalance'])->name('payretailer.getShopBalance');
/***
 * 
 * opayweb Route
 */
Route::get('opayweb/createTransactions', [Opayweb::class, 'createTransactions'])->name('opayweb.createTransactions');
Route::get('opayweb/callbackUrl', [Opayweb::class, 'callbackUrl'])->name('opayweb.callbackUrl');