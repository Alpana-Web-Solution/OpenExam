<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ResultExport;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResultExportController extends Controller
{
    //
    public function download(Request $request)
    {
        $sortField = $request->field;
        $sortDirection = $request->direction;
        return Excel::download(new ResultExport($exam->id), 'result.xlsx');

    }
    public function export(Exam $exam)
    {
        // return (new ResultExport($exam))->download('result.xlsx');
        return Excel::download(new ResultExport($exam->id), 'result.xlsx');

    }
}
