<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\SellsController;

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
//admin routes.............................................
Route::get('/edit_info',[AdminController::class,'edit_information'])->name('edit_info');
//fresh milk bottle routes............................
Route::post('/save_fresh_bottle',[AdminController::class,'save_fresh_bottle_details'])->name('save_fresh_bottle_details');
Route::patch('/update_fresh_bottle/{bottle_id}',[AdminController::class,'edit_fresh_bottle_details'])->name('edit_fresh_bottle_details');
Route::delete('/update_fresh_bottle/{bottle_id}',[AdminController::class,'remove_fresh_bottle'])->name('delete_fresh_bottle');
//end of fresh bottle routes...............................................

//mgando milk bottle routes..........................................
Route::post('/save_mgando_bottle',[AdminController::class,'save_mgando_bottle_details'])->name('save_mgando_bottle_details');
Route::patch('/update_mgando_bottle/{bottle_id}',[AdminController::class,'edit_mgando_bottle_details'])->name('edit_mgando_bottle_details');
Route::delete('/update_mgando_bottle/{bottle_id}',[AdminController::class,'remove_mgando_bottle'])->name('delete_mgando_bottle');
//end of mgando milk bottle routes......................................................... 

//mgando milk volume routes..........................................
Route::post('/save_mgando_volume',[AdminController::class,'save_mgando_volume_details'])->name('save_mgando_volume_details');
Route::patch('/update_mgando_volume/{volume_id}',[AdminController::class,'edit_mgando_volume_details'])->name('edit_mgando_volume_details');
Route::delete('/update_mgando_volume/{volume_id}',[AdminController::class,'remove_mgando_volume'])->name('delete_mgando_volume');
//end of mgando milk bottle routes....................................

//fresh milk volume routes..........................................
Route::post('/save_fresh_volume',[AdminController::class,'save_fresh_volume_details'])->name('save_fresh_volume_details');
Route::patch('/update_fresh_volume/{volume_id}',[AdminController::class,'edit_fresh_volume_details'])->name('edit_fresh_volume_details');
Route::delete('/update_fresh_volume/{volume_id}',[AdminController::class,'remove_fresh_volume'])->name('delete_fresh_volume');
//end of fresh milk bottle routes....................................

Route::get('/new_user',function(){
    return view('admin.register');
})->name('new_user')->middleware('auth','isAdmin');
Route::post('/save_user',[AuthenticationController::class,'save_user'])->name('save_user')->middleware('auth','isAdmin');
//authentication routes.....................................
Route::post('/authenticate_user',[AuthenticationController::class,'login'])->name('authenticate_user');
Route::post('/logout',function(){
    	Auth::logout();
    	return redirect()->route('login');
})->name('signout');
//income routes..............................................................
Route::resource('/income',IncomeController::class)->middleware('auth');
Route::get('/fetch_bottles/{milk_type}',[IncomeController::class,'fetch_bottles'])->name('fetch_bottles');
Route::get('/fetch_volumes/{milk_type}',[IncomeController::class,'fetch_volumes'])->name('fetch_volumes');
Route::post('/save_bottle_income',[IncomeController::class,'save_bottle_income'])->name('save_bottle_income');
Route::post('/save_litre_income',[IncomeController::class,'save_litre_income'])->name('save_litre_income');
