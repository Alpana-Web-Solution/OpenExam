<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionTrashController extends Controller
{
    public function trash()
    {
        $questions = Question::onlyTrashed()->with('subject')->paginate(20);
        return view('admin.question.trash')->withQuestions($questions);
    }

    public function restoreDeleted($question)
    {
        Question::withTrashed()
        ->where('id', $question)
        ->restore();
        return back()->with('success',__('Question Restored.'));


    }

    public function forceDelete ($question)
    {
        // permanently Delete
        Question::withTrashed()
                ->where('id', $question)
                ->forceDelete();

        return back()->with('success',__('Question Permenently Delete.'));

    }

    public function emptyTrash()
    {
        //Question already checked when deleted
        Question::onlyTrashed()->forceDelete();
        return back()->with('success',__('Question Permenently Delete.'));
    }

    public function restoreAll()
    {
        Question::onlyTrashed()->restore();
        return back()->with('success',__('All Question Restored.'));
    }
}
