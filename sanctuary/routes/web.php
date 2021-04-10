<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

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
    return view('index');
});

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/register', function () {
//     return view('register');
// });

// Auth::routes();

Route::get('/adoption', function () {
    return view('adoption');
});

Route::get('/addpet', function () {
    return view('addpet');
});

Route::get('staff/home', [HomeController::class, 'staffHome'])->name('staff.home')->middleware('is_staff');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');

Route::post('login', [LoginController::class, 'login']);