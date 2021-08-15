<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QuestionsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;

class QuestionExportInportController extends Controller

{

    public function importForm()
    {

        $subjects = Subject::whereNull('subject_id')
        ->with('childSubjects')
        ->get();

        return view('admin.question.import-export')
            ->withSubjectList($subjects);

    }
    public function import(Request $request)
    {

        $this->validate($request, [
            'import_questions' => 'required|file|mimes:xls,xlsx'
        ]);
        Excel::import(new QuestionsImport(), request()->file('import_questions'));
        return redirect()->route('admin.question.index')->with('success','Question successfully imported.');
    }

    public function export()
    {
        return Excel::download(new QuestionsExport, 'Questions.xlsx');
    }
}
