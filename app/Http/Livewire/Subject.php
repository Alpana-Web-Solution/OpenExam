<?php

namespace App\Http\Livewire;

use App\Models\Subject as ModelsSubject;
use Livewire\Component;
use Illuminate\Support\Str;

class Subject extends Component
{
    public ModelsSubject $subject;
    public $parentSubjectList;
    public $hasParent = null;
    public $parentId = null;
    public $subjectName = null;
    public $subjectCode = null;
    public $subjectDescription = null;

    protected $rules = [
        'subjectName' => 'required|min:2',
        'subjectCode'=>'nullable|min:2',
        'subjectDescription'=>'nullable|min:2'
    ];

    public function render()
    {
        $this->parentSubjectList = ModelsSubject::whereNull('subject_id')
                                                    ->with('childSubjects')
                                                    ->get();
        return view('livewire.subject');
    }

    public function addSubject()
    {
        $this->validate();

        if(empty($this->hasParent)){
            $this->parentId = null;
        }

        ModelsSubject::create([
            'name'=>$this->subjectName,
            'subject_id'=>$this->parentId,
            'code'=>$this->subjectCode,
            'description'=>$this->subjectDescription,
            'slug'=>Str::slug($this->subjectName,'-')

        ]);

         $this->dispatchBrowserEvent('alert',
        ['type' => 'success',  'message' => 'Subject, "'.$this->subjectName.'" Added Successfully!']);

        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['parentId','subjectName','hasParent','subjectCode','subjectDescription']);
    }

}
