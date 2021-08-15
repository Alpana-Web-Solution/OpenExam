<?php

namespace App\Http\Livewire\Admin;

use App\Http\Controllers\Admin\ReportQuestionController;
use App\Models\Question;
use App\Models\QuestionReport;
use Livewire\Component;

class QuestionReports extends Component
{

    public function render()
    {
        return view('livewire.admin.question-reports')
        ->with('reports',QuestionReport::paginate(20));
    }

    public function deleteReport($id)
    {
        $reportToDelte = QuestionReport::findOrFail($id);
        $reportToDelte->delete();
        $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => __('Report Deleted successfully.')]);

    }
}
