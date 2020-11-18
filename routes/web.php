<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

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
})->name('home');
Route::get('/list-messages', MailController::class.'@sendEmail')->name('listMessages');


// email routes
Route::post('/send-email', MailController::class.'@sendEmail')->name('send-email');
Route::get('/email', MailController::class.'@indexEmail')->name('email');

// sms routes
Route::post('/send-sms', SmsController::class.'@sendSms')->name('send-sms');
Route::get('/sms', SmsController::class.'@indexSms')->name('sms');
