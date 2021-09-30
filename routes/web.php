<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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
    return view('admin.index');
})->name('dashboard')->middleware('auth');
Route::get('/login',function(){
   return view('admin.login');
})->name('login')->middleware('isLoggedIn');

Route::get('/new_user',function(){
    return view('admin.register');
})->name('new_user')->middleware('auth','isAdmin');
Route::post('/save_user',[AuthenticationController::class,'save_user'])->name('save_user')->middleware('auth','isAdmin');
Route::post('/authenticate_user',[AuthenticationController::class,'login'])->name('authenticate_user');
Route::post('/logout',function(){
    	Auth::logout();
    	return redirect()->route('login');
})->name('signout');