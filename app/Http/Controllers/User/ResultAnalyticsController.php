<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Services\ExamServices;

class ResultAnalyticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Result $result)

    {
        if($result->exam->publish_result == 2){
            if (!$result->exam->end_date->isPast()){
                return redirect()->route('user.result')->with('error',__('You can check your result after exam has ended.'));
            }
        }

        // $examServices = new ExamServices();

        $result->load('exam');

        return view('user.result.analytics.index')
        ->withResult($result)
        ->withQuestions($result->exam->questions()->paginate(20))
        ->withUsersAnswer($result->answers)
        ->withUsersTime($result->time);
        // ->withExamAnsweres($examServices->calculateAnswer($result->answers,$result->exam->questions()->pluck('answer','id')));
    }
}
