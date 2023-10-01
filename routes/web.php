<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    DepartmentController,
    UserController
};

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User
Route::prefix('/user')->as('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/getList', 'getList')->name('.getList');
    Route::get('/getData', 'getData')->name('.getData');
    Route::get('/getForm', 'getForm')->name('.getForm');
    Route::post('/store', 'store')->name('.store');
    Route::get('/show', 'show')->name('.show');
    Route::post('/destroy', 'destroy')->name('.destroy');
});

// Department
Route::prefix('/department')->as('department')->controller(DepartmentController::class)->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/getList', 'getList')->name('.getList');
    Route::get('/getData', 'getData')->name('.getData');
    Route::get('/getForm', 'getForm')->name('.getForm');
    Route::post('/store', 'store')->name('.store');
    Route::get('/show', 'show')->name('.show');
    Route::post('/destroy', 'destroy')->name('.destroy');
});
