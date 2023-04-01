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
    Route::post('api/authenticate', 'authenticate')->name('api.authenticate');
    Route::post('api/query', 'query')->name('api.query');
});

Route::group(['middleware' => ["auth"]], function () {
    Route::resource('notes', NoteController::class);
    Route::controller(NoteController::class)->group(function() {
        Route::get('notes/{note}/share', 'share')->name('notes.share');
        Route::patch('notes/{note}/restore', 'restore')->name('notes.restore');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
