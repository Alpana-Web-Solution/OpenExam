<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\QuestionReport;
use App\Models\Result;
use Illuminate\Http\Request;

class QuestionReportController extends Controller
{
    public function form($resultID,$questionID)
    {
        // $question = Question::where('id',$questionID)->firstOrFail();
        $result = Result::where(['id'=>$resultID,'user_id'=>auth()->id()])->with('exam')->firstOrFail();
        $question  = $result->exam->questions()->where('id',$questionID)->firstOrFail();
        return view('user.report.question.form')
                ->withQuestion($question)
                ->withResult($result);
    }

    public function report($resultID,$questionID)
    {
        $result = Result::where(['id'=>$resultID,'user_id'=>auth()->id()])->firstOrFail();
        $question = Question::where('id',$questionID)->firstOrFail();
        QuestionReport::updateOrCreate([
            'user_id'=>auth()->id(),
            'question_id'=>$question->id],
            [
            'result_id'=>$result->id,
            'report'=>request()->report,
        ]);
        return redirect()->route('user.result.analytics',$result->id)->with('success','Your report submited.');
    }

}
