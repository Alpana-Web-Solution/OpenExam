<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;

class ExamInstructionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Exam $exam, Request $request)
    {
        $previousResult = Result::where(['exam_id'=>$exam->id,'user_id'=>auth()->id()]);

        if ($previousResult->exists()) {
            return redirect()->route('exam.attend',$exam->id);
        }

        return view('exam.instructions')->withExam($exam);
    }
}
