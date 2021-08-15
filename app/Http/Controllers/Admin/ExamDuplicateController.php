<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamDuplicateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Exam $exam)
    {
        //Get as an array and open edit form with name,ID,status blank
        // if selected with no question then nothing will be saved.
        // Get all the question associated with exam in an arry.
        $examData = $exam->toArray();
        unset(
            $examData['created_at'],
            $examData['updated_at'],
            $examData['deleted_at'],
            $examData['id'],
            $examData['name'],
            $examData['start_date'],
            $examData['end_date']
            );
        // $questions = $exam->questions()->pluck('id')->toArray();
        // ddd($examData,$questions);
        return view('admin.exam.duplicate.duplicate',$examData);

    }
}
