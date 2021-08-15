<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use App\Services\ExamServices;
use Illuminate\Http\Request;

class ExamResultAnalyticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Exam $exam, Result $result)
    {
        $result->load('exam');
        return view('admin.exam.result.analytics.index')
        ->withResult($result)
        ->withQuestions($result->exam->questions()->paginate(20))
        ->withUsersAnswer($result->answers)
        ->withUsersTime($result->time);
    }
}
