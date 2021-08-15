<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Admin\Exam\Questions;
use App\Models\Question;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class QuestionAdvanceSearch extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    // public Question $questions;
    public $showFilters;
    public $subjectList;
    public $query;
    public $nos_of_qtn_per_page =25;
    public $selectPage = false;
    public $selected = [];

    public $sort = [
        'field'=>'id',
        'direction'=>'desc'
    ];

    public $filters = [
        'search' => '',
        'difficulty' => '',
        'subject_id'=>'',
        'start_date' => null,
        'end_date' => null,
    ];

    public function mount()
    {
        $this->subjectList =  Subject::whereNull('subject_id')
                                ->with('childSubjects','childSubjects.childSubjects')
                                ->get();
    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->questionsQuery->pluck('id')->map(fn($qid) => (string) $qid);
        }else{
            $this->selected = [];
        }
    }

    public function getQuestionsQueryProperty()
    {
        return Question::query()
            ->when($this->filters['search'], fn($query, $search) => $query->where('question', 'like', '%'.$search.'%'))
            ->when($this->filters['start_date'], fn($query, $date) => $query->where('created_at', '>=', Carbon::parse($date)))
            ->when($this->filters['end_date'], fn($query, $date) => $query->where('created_at', '<=', Carbon::parse($date)))
            ->when($this->filters['subject_id'], fn($query ,$subject_id) => $query->where('subject_id',$subject_id))
            ->when($this->filters['difficulty'], fn($query ,$difficulty) => $query->where('difficulty',$difficulty))
            ->orderBy($this->sort['field'],$this->sort['direction'])
            ->with('subject')
            ->paginate($this->nos_of_qtn_per_page);
    }

    public function render()
    {
            return view('livewire.admin.question-advance-search',[
                'questions'=>$this->questionsQuery
            ]);
    }

    public function resetSearch()
    {
        $this->reset(['filters','sort']);
    }

    public function showAdvanceSearch()
    {
        $this->showFilters = !$this->showFilters;

    }

    public function deleteSelected()
    {
        if ($this->selectPage) {
            $array = $this->selected->toArray();
        }else{
            $array = $this->selected;
        }

        $getQuestions = Question::whereKey($array)->with('exams')->get();

        foreach ($getQuestions as $question) {
            // dd($question);
            if (empty($question->exams()->exists())) {

                $question->delete();
            }
        }

        $this->reset(['selected','selectPage']);

        $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => 'Question Deleted Successfully! Questions are attached to an exam can not be deleted.']);
    }

}
