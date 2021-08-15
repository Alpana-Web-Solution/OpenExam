<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\exam_user;
use App\Models\ExamResultQuestionOrder;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Services\ExamServices;

class AttendExamController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Exam $exam)
    {
        // Check if a user can attend this examination
        if ($exam->end_date->isPast()) {
            return redirect()->route('exam.index')->with('error',__('Sorry! Exam has expired.'));
        }

        $previousResult = Result::where(['exam_id'=>$exam->id,'user_id'=>auth()->id()])->first();

        if (empty($previousResult)) {
            $createResult = Result::create([
                'exam_id'=>$exam->id,
                'user_id'=>auth()->id(),
                // 'answers'=>json_encode(array()),
                'finish_time'=>now()->addSeconds($exam->duration)
            ]);
            exam_user::create([
                'exam_id'=>$exam->id,
                'user_id'=>auth()->id(),
                'result_id'=>$createResult->id
            ]);

            $questions = $exam->questions()->pluck('id')->toArray();

            if ($exam->randomise_questions) {
                shuffle($questions);
            }

            ExamResultQuestionOrder::create([
                'result_id'=> $createResult->id,
                'questions'=> $questions,
            ]);


            $resultData = $createResult;

            $exam->increment('user_attended');
        }else{

            if (\Carbon\Carbon::parse($previousResult->finish_time)->isPast() OR isset($previousResult->point)) {

                if (!isset($previousResult->point)) {
                    $examServiceInstance =  new ExamServices($previousResult);
                    $result = $examServiceInstance->calculateAndSaveFinalAnswer();

                    return redirect()->route('user.result')->with('error',__('Sorry! You have reached maximum attempts for this examination.'));
                }
                return redirect()->route('user.result')->with('error',__('Sorry! You have reached maximum attempts for this examination.'));
            }

        $resultData = $previousResult;
        }

        $resultData->load('questions');

        return view('exam.attend')
        ->withExam($exam)
        ->withResult($resultData);
    }
}
