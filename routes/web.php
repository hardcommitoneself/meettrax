<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\MeetController::class, 'list'])->name('meets.list');
Route::get('/meets/{meet}', [\App\Http\Controllers\MeetController::class, 'show'])->name('meets.show');
Route::get('/upload', [\App\Http\Controllers\MeetController::class, 'upload'])->name('meets.upload');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
