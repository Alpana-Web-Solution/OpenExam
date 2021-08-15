<?php
use Illuminate\Support\Facades\Route;

Route::get('/profile',[App\Http\Controllers\User\ProfileController::class, 'edit'])
->name('profile');
Route::get('/profile/password/form',[App\Http\Controllers\User\ProfileController::class, 'passwordform'])
->name('profile.password.form');
Route::post('/profile/password',[App\Http\Controllers\User\ProfileController::class, 'password'])
->name('profile.password');


Route::post('/profile/update',[App\Http\Controllers\User\ProfileController::class, 'update'])
->name('profile.update');

Route::get('/', App\Http\Controllers\User\DashboardController::class)->name('dashboard');

// User Question Report
Route::get('question/{result}/{question}/reportform', [App\Http\Controllers\User\QuestionReportController::class,'form'])
->name('question.reportform');
Route::post('question/{result}/{question}/report', [App\Http\Controllers\User\QuestionReportController::class,'report'])
->name('question.report');

//
Route::resource('exam', App\Http\Controllers\User\ExamController::class);
Route::get('result/{result}/analytics', App\Http\Controllers\User\ResultAnalyticsController::class)->name('result.analytics');
Route::get('result', App\Http\Controllers\User\ExamResultController::class)->name('result');

