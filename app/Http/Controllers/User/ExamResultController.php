<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $results = Result::where('user_id',auth()->id())
            ->has('exam')
            ->latest()
            ->with('exam')
            ->paginate(10);
        return view('user.result.index')->withResults($results);
    }
}
