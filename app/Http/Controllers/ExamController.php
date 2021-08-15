<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $exams = Exam::where('status',1)
        ->whereDate('end_date','>=',\Carbon\Carbon::now()->toDateTimeString())
        ->latest()
        ->paginate(15);

        return view('exam.index')->withExams($exams);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $result = Result::where('exam_id',$exam->id)
        ->orderBy('percentage','desc')
        ->select(['user_id','percentage','created_at','finish_time'])
        ->with('user')
        ->limit(10)
        ->get();
        return view('exam.show')
        ->withExam($exam)->withResults($result);
    }


}
