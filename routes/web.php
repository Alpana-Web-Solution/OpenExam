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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
	'register' => env('APP_USER_REGISTER') ?? true, //Registration status ...
    'reset' => env('APP_USER_RESET') ?? true, // Password Reset Routes...
    'verify' => env('APP_USER_VERIFY') ?? false, //Veryfy users email  ..
]);

Route::get('/exam/{exam}/instruction', App\Http\Controllers\ExamInstructionController::class)->name('exam.instruction')->middleware(['auth']);
Route::get('/exam/{exam}/attend', App\Http\Controllers\AttendExamController::class)->name('exam.attend')->middleware(['auth']);
Route::get('/exam/{exam}/finish', App\Http\Controllers\FinishExamController::class)->name('exam.finish')->middleware(['auth']);
Route::resource('exam', App\Http\Controllers\ExamController::class)->only(['index','show'])->middleware(['auth']);
