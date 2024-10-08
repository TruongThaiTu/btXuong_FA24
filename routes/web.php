<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAge;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('admin.welcome');
});

// Route::middleware(['role'])->group(function () {
    Route::resource('admin/employees', EmployeeController::class)->middleware('auth');
    Route::delete('admin/employees/{employee}/forceDestroy', [EmployeeController::class, 'forceDestroy'])
        ->name('admin.employees.forceDestroy');

    Route::resource('admin/products', ProductController::class)->middleware('auth');
    Route::delete('admin/products/{product}/forceDestroy', [ProductController::class, 'forceDestroy'])
        ->name('admin.products.forceDestroy');

    Route::resource('admin/users', UserController::class)->middleware('auth');
    Route::delete('admin/users/{user}/forceDestroy', [UserController::class, 'forceDestroy'])
        ->name('admin.users.forceDestroy');
        
// });

// Route::get('/movies', function () {
//     return "Chào mừng đến với trang phim!";
// })->middleware('checkage');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
