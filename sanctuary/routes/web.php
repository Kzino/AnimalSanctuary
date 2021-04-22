<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

//Auth routes
Auth::routes();

//Auth redirect
Route::get('/auth', [AuthenticationController::class, 'index'])->name('auth');

//Public user routes
Route::get('/home/{type?}/{view?}', [HomeController::class, 'index'])->name('home'); 
Route::get('/request/{status?}', [RequestController::class, 'index'])->name('request');
Route::post('/request/adopt', [RequestController::class, 'adopt'])->name('request_adopt');

//Staff user routes
Route::get('staff/home', [HomeController::class, 'staffHome'])->name('staff.home')->middleware('is_staff');
Route::get('staff/request/{type?}', [RequestController::class, 'staffRequest'])->name('staff.request')->middleware('is_staff');
Route::post('staff/request/accept', [RequestController::class, 'accept'])->name('staff.request_accept');
Route::post('staff/request/deny', [RequestController::class, 'deny'])->name('staff.request_deny');
Route::get('staff/animal', [AnimalController::class, 'staffAnimal'])->name('staff.animal')->middleware('is_staff');
Route::get('staff/animal/add', [AnimalController::class, 'staffAnimalAdd'])->name('staff.animal_add')->middleware('is_staff');
Route::post('staff/animal/add', [AnimalController::class, 'store'])->name('staff.animal_add');


//Display images
Route::get('storage/uploads/{filename}', function ($filename)
{
    $path = storage_path('app/public/uploads/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});