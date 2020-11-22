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


// email routes   add middleware
Route::post('/send-email', MailController::class.'@sendEmail')->name('send-email');
Route::get('/email', MailController::class.'@indexEmail')->name('email');
Route::get('/list-all-email-messages', MailController::class.'@listAllEmailMessages')->name('listAllEmailMessages');
Route::get('/list-fetched-email-messages', MailController::class.'@listFetchedEmailMessages')->name('listFetchedEmailMessages');
Route::get('/list-failed-email-messages', MailController::class.'@listFailedEmailMessages')->name('listFailedEmailMessages');
Route::delete('/delete-email', MailController::class.'@deleteMail')->name('deleteMail');

// sms routes   add middleware
Route::post('/send-sms', SmsController::class.'@sendSms')->name('send-sms');
Route::get('/sms', SmsController::class.'@indexSms')->name('sms');
Route::get('/list-all-sms-messages', SmsController::class.'@listAllSmsMessages')->name('listAllSmsMessages');
Route::get('/list-fetched-sms-messages', SmsController::class.'@listFetchedSmsMessages')->name('listFetchedSmsMessages');
Route::get('/list-failed-sms-messages', SmsController::class.'@listFailedSmsMessages')->name('listFailedSmsMessages');
Route::delete('/delete-sms', SmsController::class.'@deleteSms')->name('deleteSms');
