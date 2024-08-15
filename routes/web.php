<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

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
    return view('Homepage/index');
});

Route::get('/test', function () {
    return view('Homepage/test');
});

Route::get('/admin', function () {
    return view('Admin/index');
});

Route::get('/admin/employee', function () {
    return view('Admin/Employee');
});

Route::get('/admin/employee', function () {
    return view('Admin/Employee');
});

Route::post('/admin/add', [MainController::class, 'add']);
Route::get('/admin/all', [MainController::class, 'all']);