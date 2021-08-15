<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamCreateReqeust;
use App\Models\Exam;
use App\Models\Subject;
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
     return view('admin.exam.crud.index')->withExams(Exam::latest()->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exam.crud.create')
        ->withSubjectList(Subject::whereNull('subject_id')
                                    ->with('childSubjects')
                                    ->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamCreateReqeust $request)
    {
        $data = $request->validated();

        if (!empty(request()->randomise_questions)) {
            $data['randomise_questions'] = 1;
        }
        if (empty(request()->attend_negative_marking)) {
            $data['attend_negative_marking'] = 0;
        }else{
            $data['attend_negative_marking'] = 1;
        }

        unset($data['start_date'],$data['end_date']);
        $data['start_date'] = \Carbon\Carbon::parse($request->start_date);
        $data['end_date'] = \Carbon\Carbon::parse($request->end_date);
        $data['user_attended'] = 0;

        Exam::create($data);
        return redirect()->route('admin.exam.index')->with('success',__('Exam Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('admin.exam.crud.show')
                ->withExam($exam)
                ->withQuestions($exam->questions()->paginate(20));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('admin.exam.crud.edit',$exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamCreateReqeust $request, Exam $exam)
    {
        if ($exam->status == 1 ) {
            return redirect()->back()->with('error','Ongoing Exam Can not be changed.');
        }

        $data = $request->validated();

        if (!empty(request()->randomise_questions)) {
            $data['randomise_questions'] = 1;
        }

        if (empty(request()->attend_negative_marking)) {
            $data['attend_negative_marking'] = 0;
        }

        unset($data['start_date'],$data['end_date']);
        $data['start_date'] = \Carbon\Carbon::parse($request->start_date);
        $data['end_date'] = \Carbon\Carbon::parse($request->end_date);
        $exam->update($data);
        return redirect()->route('admin.exam.show',$exam->id)->with('success',__('Updated!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exam.index')->with('success','Exam successfully Deleted.');
    }

    public function status(Exam $exam)
    {
        return view('admin.exam.crud.status')->withExam($exam);
    }
    public function statusupdate(Request $request,Exam $exam)
    {
        $requiredQuestion = $exam->total_marks/$exam->default_mark;
        if ($requiredQuestion != $exam->questions()->count()) {
            return back()->with('error', __('Please Add Or Remove questions before changing exam status.'));
        }


        $exam->update(['status'=>intval($request->status)]);
        return redirect()
            ->route('admin.exam.show',$exam->id)
            ->with('info','Status Updated.');
    }


}
