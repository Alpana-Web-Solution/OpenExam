<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectUpdateRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

use Str;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subject.index')
        ->withSubjects(
            Subject::with('parentSubject')
            ->paginate(20)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //I am using Livewire to create a subject.
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return view('admin.subject.view')
        ->withSubject($subject->load('parentSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit')
        ->withSubject($subject)
        ->withParentSubjectList(
            Subject::whereNull('subject_id')
            ->with('childSubjects')
            ->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectUpdateRequest $request, Subject $subject)
    {
        $data = $request->validated();
        $subject->update([
            'name'=>$data['subjectName'],
            'code'=>$data['subjectCode'],
            'description'=>$data['subjectDescription'],
            'subject_id'=> $data['parent'],
            'slug'=>Str::slug($data['subjectName'])
        ]);

        return redirect()
        ->route('admin.subject.show',$subject->id)
        ->with('success','Subject Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        // Temp delete subject

        $subject->delete();
        return back()->with('success','Subject Deleted');
    }

    public function trash()
    {
        // Show the trash

        $subjects = Subject::onlyTrashed()->with('parentSubject')->paginate(20);
        return view('admin.subject.trash')->withSubjects($subjects);
        // dd($subjects);
    }

    public function restoreDeleted($subject)
    {
        // Restore Deleted Subject

        $subjectData = Subject::withTrashed()
                ->where('id', $subject)
                ->restore();
        return back()->with('success','Subject Restored.');
    }

    public function forceDelete ($subject)
    {
        // permanently Delete
        $subjectData = Subject::withTrashed()
                ->where('id', $subject)
                ->forceDelete();

        return back()->with('success','Subject Permenently Delete.');
    }
}
