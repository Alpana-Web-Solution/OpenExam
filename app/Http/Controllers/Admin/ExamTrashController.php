<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamTrashController extends Controller
{
    public function trash()
    {
        $exams = Exam::onlyTrashed()->paginate(20);
        return view('admin.exam.crud.trash')->withExams($exams);


    }

    public function restoreDeleted($exam)
    {
        Exam::withTrashed()
        ->where('id', $exam)
        ->restore();
        return back()->with('success','Exam Restored.');


    }

    public function forceDelete ($exam)
    {
        // permanently Delete
        Exam::withTrashed()
                ->where('id', $exam)
                ->forceDelete();

        return back()->with('success','Question Permenently Delete.');

    }
}
