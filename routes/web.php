<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Employee;

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

Route::get('/', function () {
    //return view('welcome');
    return Redirect::to('login');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Application cache has been cleared';
});

Route::resource('login', Login::class);
Route::resource('logout', Logout::class);

//Route::get('/', 'Login@index');
//Route::post('/store', 'Login@store');

 // Middleware for check admin login authentication
    Route::group(['middleware' => 'admin_auth'], function () {
Route::resource('employee', Employee::class);
Route::get('/employee/view/{emp_id}', [Employee::class, 'GetByEmpId'])->name('employee.GetByEmpId');
});
