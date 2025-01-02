<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login', function () {
    return view('welcome');
});
Auth::routes();
Route::get('logout',[LoginController::class,'logout']);


//Forntend Side
Route::get('customer', [CustomerController::class, 'index'])->name('customer');
Route::post('store', [CustomerController::class, 'store'])->name('customerstore');

//Backend Side
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('customerview', [CustomerController::class, 'showcustomer'])->name('customershow');
Route::get('customercreate', [CustomerController::class, 'create'])->name('customercreate');
Route::get('customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customerdelete');

//Customer Pre Mail
Route::get('customer/singlemail/{id}', [CustomerController::class, 'singlemailTemp'])->name('singlemailtemp');
Route::post('customer/singlemailsend', [CustomerController::class, 'singlemailsend'])->name('singlemailsend');

//Mail Index
Route::get('customermail', [CustomerController::class, 'customerIndex'])->name('customermail');
Route::get('allmailsend', [CustomerController::class, 'mailSend'])->name('allmailsend');
Route::post('selectedmailsend', [CustomerController::class, 'selectedmailsend'])->name('selectedmailsend');

//SMS
Route::get('sms', [CustomerController::class, 'smsindex'])->name('smsindex');
Route::get('sms/{id}', [CustomerController::class, 'smscreate'])->name('smscreate');
Route::post('/sms/send', [CustomerController::class, 'sendSms'])->name('sms.send');





