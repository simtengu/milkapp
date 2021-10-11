<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellsController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExpenseController;
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

Route::get('/', [AdminController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/login', function () {
    return view('admin.login');
})->name('login')->middleware('isLoggedIn');
//admin routes.............................................
Route::get('/edit_info', [AdminController::class, 'edit_information'])->name('edit_info');
//fresh milk bottle routes............................
Route::post('/save_fresh_bottle', [AdminController::class, 'save_fresh_bottle_details'])->name('save_fresh_bottle_details');
Route::patch('/update_fresh_bottle/{bottle_id}', [AdminController::class, 'edit_fresh_bottle_details'])->name('edit_fresh_bottle_details');
Route::delete('/delete_fresh_bottle/{bottle_id}', [AdminController::class, 'remove_fresh_bottle'])->name('delete_fresh_bottle');
//end of fresh bottle routes...............................................

//mgando milk bottle routes..........................................
Route::post('/save_mgando_bottle', [AdminController::class, 'save_mgando_bottle_details'])->name('save_mgando_bottle_details');
Route::patch('/update_mgando_bottle/{bottle_id}', [AdminController::class, 'edit_mgando_bottle_details'])->name('edit_mgando_bottle_details');
Route::delete('/delete_mgando_bottle/{bottle_id}', [AdminController::class, 'remove_mgando_bottle'])->name('delete_mgando_bottle');
//end of mgando milk bottle routes......................................................... 

//mgando milk volume routes..........................................
Route::post('/save_mgando_volume', [AdminController::class, 'save_mgando_volume_details'])->name('save_mgando_volume_details');
Route::patch('/update_mgando_volume/{volume_id}', [AdminController::class, 'edit_mgando_volume_details'])->name('edit_mgando_volume_details');
Route::delete('/delete_mgando_volume/{volume_id}', [AdminController::class, 'remove_mgando_volume'])->name('delete_mgando_volume');
//end of mgando milk volume routes....................................

//fresh milk volume routes..........................................
Route::post('/save_fresh_volume', [AdminController::class, 'save_fresh_volume_details'])->name('save_fresh_volume_details');
Route::patch('/update_fresh_volume/{volume_id}', [AdminController::class, 'edit_fresh_volume_details'])->name('edit_fresh_volume_details');
Route::delete('/delete_fresh_volume/{volume_id}', [AdminController::class, 'remove_fresh_volume'])->name('delete_fresh_volume');
//end of fresh milk bottle routes....................................

//yogurt  bottle routes..........................................
Route::post('/save_yogurt_bottle', [AdminController::class, 'save_yogurt_bottle_details'])->name('save_yogurt_bottle_details');
Route::patch('/update_yogurt_bottle/{bottle_id}', [AdminController::class, 'edit_yogurt_bottle_details'])->name('edit_yogurt_bottle_details');
Route::delete('/delete_yogurt_bottle/{bottle_id}', [AdminController::class, 'remove_yogurt_bottle'])->name('delete_yogurt_bottle');
//end of yogurt bottle routes......................................................... 


Route::get('/new_user', function () {
    return view('admin.register');
})->name('new_user')->middleware('auth', 'isAdmin');
Route::post('/save_user', [AuthenticationController::class, 'save_user'])->name('save_user')->middleware('auth', 'isAdmin');
//authentication routes.....................................
Route::post('/authenticate_user', [AuthenticationController::class, 'login'])->name('authenticate_user');
Route::get('/edit_details', [AdminController::class, 'edit_details'])->name('edit_details');
Route::patch('/update_details', [AdminController::class, 'update_details'])->name('update_details');
Route::delete('/remove_user/{user_id}', [AdminController::class, 'remove_system_user'])->name('remove_user');
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('signout');
//income routes..............................................................
Route::resource('/income', IncomeController::class)->middleware('auth');
Route::get('/fetch_bottles/{milk_type}', [IncomeController::class, 'fetch_bottles'])->name('fetch_bottles');
Route::get('/fetch_volumes/{milk_type}', [IncomeController::class, 'fetch_volumes'])->name('fetch_volumes');
Route::post('/save_bottle_income', [IncomeController::class, 'save_bottle_income'])->name('save_bottle_income');
Route::post('/save_litre_income', [IncomeController::class, 'save_litre_income'])->name('save_litre_income');
Route::post('/save_yogurt_income', [IncomeController::class, 'save_yogurt_income'])->name('save_yogurt_income');
// update income routes....................................................................
Route::get('/edit_bottle_income/{income_id}', [IncomeController::class, 'edit_bottle_income'])->name('edit_bottle_income');
Route::patch('/update_bottle_income/{income_id}',[IncomeController::class,'update_bottle_income'])->name('update_bottle_income');

Route::get('/edit_litre_income/{income_id}', [IncomeController::class, 'edit_litre_income'])->name('edit_litre_income');
Route::patch('/update_litre_income/{income_id}',[IncomeController::class,'update_litre_income'])->name('update_litre_income');

Route::get('/edit_yogurt_income/{income_id}', [IncomeController::class, 'edit_yogurt_income'])->name('edit_yogurt_income');
Route::patch('/update_yogurt_income/{income_id}',[IncomeController::class,'update_yogurt_income'])->name('update_yogurt_income');
//end of income update routes.............................................................. 
//remove income routes.................................................................. 
Route::delete('/remove_bottle_income/{income_id}', [IncomeController::class, 'remove_bottle_income'])->name('remove_bottle_income');
Route::delete('/remove_litre_income/{income_id}', [IncomeController::class, 'remove_litre_income'])->name('remove_litre_income');
Route::delete('/remove_yogurt_income/{income_id}', [IncomeController::class, 'remove_yogurt_income'])->name('remove_yogurt_income');
//end of remove income routes..........................................................

//Expenses routes..............................................................
Route::resource('/expense', ExpenseController::class)->middleware('auth');

//admin reports routes..............................................................
Route::get('/general_report', [ReportController::class, 'index'])->name('general.report');
Route::get('/all_data_report', [ReportController::class, 'all_data'])->name('all.report');
Route::post('/date_report', [ReportController::class, 'date_data'])->name('date.report');
Route::post('/date_range_report', [ReportController::class, 'date_range_data'])->name('date_range.report');

//admin reports print routes..............................................................
Route::get('/print/print_reports', [ReportController::class, 'print_reports'])->name('print_reports');
Route::get('/print/general_report', [ReportController::class, 'print_index'])->name('print.general.report');
Route::get('/print/all_data_report', [ReportController::class, 'print_all_data'])->name('print.all.report');
Route::post('print//date_report', [ReportController::class, 'print_date_data'])->name('print.date.report');
Route::post('print//date_range_report', [ReportController::class, 'print_date_range_data'])->name('print.date_range.report');

//end of admin reports routes.......................................................
Route::get('/testing',function(){
    
  return Carbon::today()->toDateString()." and ".Carbon::today()->subDay();
});