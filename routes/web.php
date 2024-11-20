<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('home.index');
});

Route::get('account/register',[AccountController::class,'register'])->name('account.register');
Route::post('account/registerProcess',[AccountController::class,'processRegister'])->name('account.processRegister');
Route::get('account/login',[AccountController::class,'login'])->name('account.login');
Route::post('account/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');
Route::get('account/index',[AccountController::class,'index'])->name('account.index');

Route::get('account/donate',[AccountController::class,'donate'])->name('account.donate');
Route::post('account/registerDonor',[AccountController::class,'registerDonor'])->name('account.registerDonor');
Route::get('account/require',[AccountController::class,'require'])->name('account.require');

Route::get('account/yourDonations', [AccountController::class,'yourDonations'])->name('account.yourDonations');
Route::delete('account/delete_donation/{id}',[AccountController::class,'delete_donation'])->name('account.delete_donation');

Route::get('/requests/send/{donationId}', [RequestController::class, 'sendRequestForm'])->name('requests.sendForm');
Route::post('/requests/send', [RequestController::class, 'sendRequest'])->name('requests.send');
Route::get('/requests/received', [RequestController::class, 'receivedRequests'])->name('requests.received');

Route::post('requests/accept/{id}', [RequestController::class, 'accept_request'])->name('requests.accept');
Route::post('requests/reject/{id}', [RequestController::class, 'reject_request'])->name('requests.reject');
Route::get('/requests/yourSentRequests', [RequestController::class, 'yourSentRequests'])->name('requests.yourSentRequests');
Route::delete('requests/delete_request/{id}',[RequestController::class,'delete_request'])->name('requests.delete_request');

Route::get('/account/search', [SearchController::class, 'search'])->name('account.search');