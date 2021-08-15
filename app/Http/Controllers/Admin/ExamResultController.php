<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Exam $exam)
    {
        // $exam->load('results','results.user');
        $results = $exam->results()->with('user')->latest()->paginate(20);
        return view('admin.exam.result.index')->withExam($exam)->withResults(($results));

    }
}
