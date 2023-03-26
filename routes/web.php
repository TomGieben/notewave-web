<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\NoteController;
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
    return view('welcome');
});

Auth::routes();

Route::controller(ApiController::class)->group(function() {
    Route::post('api/authenticate', 'authenticate');
});

Route::group(['middleware' => ["auth"]], function () {
    Route::controller(NoteController::class)->group(function() {
        Route::resource('notes', NoteController::class);
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
