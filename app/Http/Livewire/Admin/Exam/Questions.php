<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Question;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class Questions extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $exam;
    public $search;
    public $selected = [];
    public $selectPage = false;
    public $showFilters = false;
    public $subjectList;
    public $nos_of_qtn_per_page = 10;
    public $addedQuestions;
    public $doNotShowAddedQuestions;
    public $showConfirmationDialouge = 1;

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

    public function mount($exam)
    {
        if ($exam->status == 1 ) {
            session()->flash('error', 'Sorry! Exam can not be changed.');
            $this->redirectRoute('admin.exam.show',$exam->id);
        }

        $this->exam =$exam;
        $this->addedQuestions = $exam->questions()->pluck('id')->toArray();
        $this->subjectList =  Subject::whereNull('subject_id')
                                ->with('childSubjects','childSubjects.childSubjects')
                                ->get();
    }

    public function render()
    {
            $questions = $this->questionsQuery;
            return view('livewire.admin.exam.questions')
            ->withQuestions($questions)
            ->withAddedQuestions($this->addedQuestions);
    }

    public function getQuestionsQueryProperty()
    {
        return Question::query()
        ->when($this->filters['search'], fn($query, $search) => $query->where('question', 'like', '%'.$search.'%'))
        ->when($this->filters['start_date'], fn($query, $date) => $query->where('created_at', '>=', Carbon::parse($date)))
        ->when($this->filters['end_date'], fn($query, $date) => $query->where('created_at', '<=', Carbon::parse($date)))
        ->when($this->filters['subject_id'], fn($query ,$subject_id) => $query->where('subject_id',$subject_id))
        ->when($this->filters['difficulty'], fn($query ,$difficulty) => $query->where('difficulty',$difficulty))
        ->when($this->doNotShowAddedQuestions, function ($query)
        {
            $query->whereNotIn('id',$this->addedQuestions);
        })
        ->orderBy($this->sort['field'],$this->sort['direction'])
        ->paginate($this->nos_of_qtn_per_page);
    }

    public function resetSearch()
    {
        $this->reset(['filters','sort']);
    }

    public function showAdvanceSearch()
    {
        $this->showFilters = !$this->showFilters;

    }

    public function updatedSelectPage($value)
    {
        if ($value) {
            $this->selected = $this->questionsQuery->pluck('id')->map(fn($qid) => (string) $qid);
        }else{
            $this->selected = [];
        }
    }

    public function updatedSelected($value){
        $this->selectPage = false;

    }

    public function addSelected()
    {
        if ($this->selectPage) {
            $arr = array_diff($this->selected->toArray(), $this->addedQuestions, array());
        }else{
            $arr = array_diff($this->selected, $this->addedQuestions, array());
        }

        $this->exam->questions()->attach($arr);
        $this->addedQuestions = $this->exam->questions()->pluck('id')->toArray();

        if ($this->showConfirmationDialouge) {
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => __('Question Added Successfully To This Exam.')]);
        }

        $this->reset(['selected','selectPage']);
    }

    public function removeSelected()
    {
        $this->exam->questions()->detach($this->selected);
        $this->addedQuestions = $this->exam->questions()->pluck('id')->toArray();

        if ($this->showConfirmationDialouge) {
            $this->dispatchBrowserEvent('alert',
            ['type' => 'error',  'message' => __('Question Removed Successfully To This Exam.')]);
        }
        $this->reset(['selected','selectPage']);

    }

    public function addToExam($question_id)
    {
        $this->exam->questions()->attach($question_id);
        $this->addedQuestions = $this->exam->questions()->pluck('id')->toArray();

        if ($this->showConfirmationDialouge) {
            $this->dispatchBrowserEvent('alert',
            ['type' => 'success',  'message' => __('Question Added Successfully To This Exam.')]);
        }
    }

    public function removeFromExam($question_id)
    {
        $this->exam->questions()->detach($question_id);
        $this->addedQuestions = $this->exam->questions()->pluck('id')->toArray();
        if ($this->showConfirmationDialouge) {
            $this->dispatchBrowserEvent('alert',
            ['type' => 'warning',  'message' => __('Question Deleted Successfully From This Exam.')]);
        }
    }

    public function resetQuestions()
    {
        $this->exam->questions()->detach();
        $this->addedQuestions = $this->exam->questions()->pluck('id')->toArray();

    }

}
