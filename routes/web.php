<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoveController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\UserController;
// use Illuminate\Auth\Middleware\Authenticate;
// use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/',function(){
    return view('index');
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

Route::controller(HomeController::class)->group(function(){
    Route::get('/blog/search','searchBlog')->name('search.blog');
    Route::get('/blog/comment/{id}','commentBlog')->name('comment.blog');

});

Route::resource('profile',UserController::class);
Route::resource('blog',BlogController::class);
Route::resource('commend',CommentController::class);
Route::resource('love',LoveController::class);





