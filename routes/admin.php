<?php
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

Route::redirect('/', '/admin/dashboard');

// Route::get('/', function () { return view('admin.dashboard'); })->name('admin');

    // User Manager Reset password sent emails.
Route::post('usermanager/{usermanager}/resetpassword',
	[App\Http\Controllers\Admin\UserManagerController::class,'resetPassword'])
->name('usermanager.resetpassword');

// Tag Controller
Route::resource('tag', App\Http\Controllers\Admin\TagController::class)->only(['create','index','store','destroy']);
    // Usermanager
Route::resource('usermanager', App\Http\Controllers\Admin\UserManagerController::class);
Route::get('subject/trash',[App\Http\Controllers\Admin\SubjectController::class,'trash'])
->name('subject.trash');
Route::post('subject/forceDelete/{subject}',[App\Http\Controllers\Admin\SubjectController::class,'forceDelete'])
->name('subject.forceDelete');
Route::post('subject/restoreDeleted/{subject}',[App\Http\Controllers\Admin\SubjectController::class,'restoreDeleted'])
->name('subject.restoreDeleted');
Route::resource('subject', App\Http\Controllers\Admin\SubjectController::class);

// Exam Route Starts
Route::get('exam/trash',[App\Http\Controllers\Admin\ExamTrashController::class,'trash'])
->name('exam.trash');

Route::post('exam/forceDelete/{exam}',[App\Http\Controllers\Admin\ExamTrashController::class,'forceDelete'])
->name('exam.forceDelete');

Route::post('exam/restoreDeleted/{exam}',[App\Http\Controllers\Admin\ExamTrashController::class,'restoreDeleted'])
->name('exam.restoreDeleted');

Route::get('exam/draft',App\Http\Controllers\Admin\ExamDraftController::class)
->name('exam.draft');

Route::get('exam/{exam}/duplicate',App\Http\Controllers\Admin\ExamDuplicateController::class)
->name('exam.duplicate');
// Exam Questions
Route::get('exam/{exam}/questions', App\Http\Controllers\Admin\ExamQuestionsController::class)
->name('exam.questions');
Route::get('exam/{exam}/result/{result}/analytics', App\Http\Controllers\Admin\ExamResultAnalyticsController::class)
->name('exam.result.analytics');//

Route::get('exam/{exam}/result', App\Http\Controllers\Admin\ExamResultController::class)
->name('exam.result');

// Exam Result export
Route::get('exam/{exam}/result/export', [App\Http\Controllers\Admin\ResultExportController::class,'export'])
->name('exam.result.export');

Route::get('exam/{exam}/result/download', [App\Http\Controllers\Admin\ResultExportController::class,'download'])
->name('exam.result.download');


Route::get('exam/{exam}/status', [App\Http\Controllers\Admin\ExamController::class,'status'])
->name('exam.status');
Route::post('exam/{exam}/statusupdate', [App\Http\Controllers\Admin\ExamController::class,'statusupdate'])
->name('exam.statusupdate');
Route::resource('exam', App\Http\Controllers\Admin\ExamController::class);

// Question Routes Start
Route::get('question/trash',[App\Http\Controllers\Admin\QuestionTrashController::class,'trash'])
->name('question.trash');
Route::post('question/trash/empty',[App\Http\Controllers\Admin\QuestionTrashController::class,'emptyTrash'])
->name('question.trash.empty');
Route::post('question/trash/restoreAll',[App\Http\Controllers\Admin\QuestionTrashController::class,'restoreAll'])
->name('question.trash.restoreAll');
Route::post('question/forceDelete/{question}',[App\Http\Controllers\Admin\QuestionTrashController::class,'forceDelete'])
->name('question.forceDelete');
Route::post('question/restoreDeleted/{question}',[App\Http\Controllers\Admin\QuestionTrashController::class,'restoreDeleted'])
->name('question.restoreDeleted');

// Question Report
Route::get('question/report', App\Http\Controllers\Admin\ReportQuestionController::class)->name('question.report');

// Question Import Export
Route::get('question/import/form', [App\Http\Controllers\Admin\QuestionExportInportController::class,'importForm'])
->name('question.importform');
Route::post('question/import', [App\Http\Controllers\Admin\QuestionExportInportController::class,'import'])
->name('question.import');
Route::post('question/export', [App\Http\Controllers\Admin\QuestionExportInportController::class,'export'])
->name('question.export');

Route::resource('question', App\Http\Controllers\Admin\QuestionController::class);
