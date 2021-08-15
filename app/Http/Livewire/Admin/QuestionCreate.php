<?php

namespace App\Http\Livewire\Admin;

use App\Models\Question;
use App\Models\Subject;
use App\Models\Tag;
use Livewire\Component;

class QuestionCreate extends Component
{
    public $subject_id = null;
    public $point = 1;
    public $difficulty = 1;
    public $question = null;
    public $options;
    public $answer=1;
    public $createAnother;
    public $tags = '';
    public $allTags;
    public $subjectList;
    public $help ='';

    protected $rules = [
        'subject_id' => 'required',
        'difficulty'=>'required',
        'point'=>'required',
        'question'=>'required|string|min:2',
        'options'=>'required|array',
        'answer' => 'required|integer|max:4',
        'tags'=>'nullable',
        'help'=>'nullable'
    ];

    public function mount()
    {
        $this->allTags = Tag::all()->pluck('name','id')->toArray();
        $this->subjectList = Subject::whereNull('subject_id')
                        ->with('childSubjects','childSubjects.childSubjects')
                        ->get();
    }

    public function render()
    {
        return view('livewire.admin.question-create');

    }

    public function save()
    {
        $this->validate();

        $questionCreate = Question::create([
                'subject_id' => $this->subject_id,
                'difficulty'=>$this->difficulty,
                'point'=>$this->point,
                'question'=>$this->question,
                'options'=>$this->options,
                'answer' => $this->answer,
                'help'=>$this->help
                ]);

        if (!empty($this->tags)) {
            $questionCreate->tags()->attach($this->tags);
        }

        if (empty($this->createAnother)) {
            return redirect()->route('admin.question.index',['success'=>__('Question added successfully.')]);
            }

        $this->reset(['question','options','answer','createAnother','help']);

        $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => 'Question , "'.$this->question.'" Added Successfully!']);
    }

    public function createAnother()
    {
        $this->createAnother = 1;
        $this->save();
    }


}
