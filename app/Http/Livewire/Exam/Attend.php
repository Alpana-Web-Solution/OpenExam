<?php

namespace App\Http\Livewire\Exam;

use App\Models\Question;
use App\Models\Result;
use App\Models\ResultAnswer;
use App\Services\ExamServices;
use Carbon\Carbon;
use Livewire\Component;

class Attend extends Component
{
    public $exam;
    public $result;
    public $examQuestions;
    public $questionDetails;
    public $currentQuestionAnswer = null;
    public int $usersAnswer = 0;
    public int $currentQuestion = 0;
    public $time;
    public $progress = 0;

    protected $rules = [
        'usersAnswer' => 'required|integer|min:1|max:4',
    ];
    protected $messages = [
        'usersAnswer.min' => 'Please select an Answer Before Save. Or Click Skip to skip this question.',
    ];


    public function mount($exam,$result)
    {
        $this->exam = $exam;

        $this->result = $result;

        $this->examQuestions = $result->questions->questions;


    }


    public function render()
    {
        if ($this->result->finish_time->isPast()) {
            $this->finishExam();
        }

        $this->reset(['usersAnswer']);

        $this->questionDetails = Question::findOrFail($this->examQuestions[$this->currentQuestion]);

        $this->progress = 100* (($this->currentQuestion + 1) / count($this->examQuestions));


        $currentQuestionAnswer = ResultAnswer::where(['result_id'=>$this->result->id,'question_id'=> $this->examQuestions[$this->currentQuestion]])->first();

        if (!empty($currentQuestionAnswer)) {
            $this->usersAnswer = $currentQuestionAnswer->answer;
            $this->currentQuestionAnswer = $currentQuestionAnswer;
        }

        $this->time = now();

        return view('livewire.exam.attend');
    }


    public function jumpToQuestion($question)
    {
        // No time is stored when jumping question to question.
        $this->currentQuestion = $question;
    }


    public function addAnswerResponse()
    {
        // Save the answer to a database or update if exists
        $this->validate();

        if (is_null($this->currentQuestionAnswer)) {
            ResultAnswer::Create([
                'result_id'=>$this->result->id,
                'question_id'=> $this->questionDetails->id,
                'answer'=> $this->usersAnswer,
                'time'=> now()->diffInSeconds(Carbon::parse($this->time))
                ]);
        }else{
            $this->currentQuestionAnswer->update([
                'answer'=> $this->usersAnswer,
                'time'=> now()->diffInSeconds(Carbon::parse($this->time))+ $this->currentQuestionAnswer['time'],
                ]);
        }

        $this->reset(['usersAnswer']);

        if (count($this->examQuestions) == ($this->currentQuestion + 1)) {
            $this->currentQuestion = 0;
        }else{
        // add next question
        $this->currentQuestion++;
        }

    }


    function skipQuestion()
    {
        if (! is_null($this->currentQuestionAnswer)) {
            $this->currentQuestionAnswer->update([
                'answer'=> 0,
                'time'=> now()->diffInSeconds(Carbon::parse($this->time))+ $this->currentQuestionAnswer['time'],
                ]);
        }else{
            ResultAnswer::Create([
                'result_id'=>$this->result->id,
                'question_id'=> $this->questionDetails->id,
                'answer'=> 0,
                'time'=> now()->diffInSeconds(Carbon::parse($this->time))
                ]);
        }

        if (count($this->examQuestions) == ($this->currentQuestion + 1)) {
            $this->currentQuestion = 0;
        }else{
        // add next question
            $this->currentQuestion++;
        }

    }


    public function finishExam()
    {
        $getResult = new ExamServices($this->result);
        $result = $getResult->calculateAndSaveFinalAnswer();

        session()->flash('success', __('Exam Finished Successfully. Check Your Result Here.'));
        return redirect()->route('user.result');

    }

}
