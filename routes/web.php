<?php

use App\Http\Controllers\ValidationController;
// use Illuminate\Auth\Middleware\Authenticate;
// use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/',function(){
    return 'oke';
})->name('home');


Route::controller(ValidationController::class)->group(function(){
    // Route::middleware(RedirectIfAuthenticated::class)->group(function(){
    // });
    Route::get('/register','register')->name('register');
    Route::post('/register','ValidationRegister')->name('register.validate');
    Route::get('/login','login')->name('login');
    Route::post('/login','ValidationLogin')->name('login.validate');

    // Route::middleware(Authenticate::class)->group(function(){
    // });
    Route::get('/logout','logout')->name('logout');
});



