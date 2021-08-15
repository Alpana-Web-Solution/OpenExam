<?php
namespace App\Services;

use App\Models\Result;

// Todo skipped questions marked as negetive

class ExamServices
{
    public $result;
    // public $exam;

    public function __construct($result) {
        $this->result = $result;
    }

    public function calculateAndSaveFinalAnswer()
    {

        $examQuestionsAnswer = $this->result->exam->questions()->pluck('answer','id')->toArray();

        $answer = $this->result->answers()->pluck('answer','question_id')->toArray();
        $time = $this->result->answers()->pluck('time','question_id')->toArray();
        // $skipped = $this->result->answers()->whereNotNull('skipped')->pluck('question_id')->toArray();

        $answerArray = $this->calculateAnswer($answer,$examQuestionsAnswer);

        $point = $this->calculatePoint($answerArray,$this->result->exam);

        // Delete data
        $this->result->answers()->delete();
        $this->result->questions()->delete();

        // Save the result
        $this->result->answers = $answer;
        $this->result->time = $time;
        $this->result->point = $point;

        if ($point == 0) {
            $this->result->percentage = 0;
        }else{

            $this->result->percentage = ($point / $this->result->exam->total_marks*100);
        }
        $this->result->update();

        return true;

    }

    public function calculateAnswer($usersAnswer, $examQuestionsAnswer,$skippedQuestionHasNegetiveMark = 0): array
    {
        $correctAnswer = 0;
        $wrongAnswer = 0;
        $skipped = 0;

        foreach ($usersAnswer as $question => $answer) {
            if ($examQuestionsAnswer[$question] == $answer) {
                $correctAnswer++;
            }
            elseif(empty($answer))
            {
                $skipped++;
            }
            else
            {
                $wrongAnswer++;

            }
        }


        return array(
            'correctAnswer'=>$correctAnswer,
            'wrongAnswer'=>$wrongAnswer,
            'skipped'=>$skipped,
            // 'notAnswered'=>($examQuestionsAnswer->count() - $usersAnswer->count())
        );

    }

    public function calculatePoint($answer,$exam)
    {
        $point = 0;

        if (!empty($exam->default_mark)) {
            $point  = $answer['correctAnswer'] * $exam->default_mark;
        }

        if (!empty($exam->negative_mark)) {
           $point = $point - ($answer['wrongAnswer'] * ($exam->negative_mark/100));
        }

        if ($exam->attend_negative_marking == 2) {
           $point  = $point - ($answer['notAnswered'] * ($exam->negative_mark/100));
        }

        return $point;
    }

    public function usersEligibility($exam)
    {
        $previousResult = Result::where(['exam_id'=>$exam->id,'user_id'=>auth()->id()])->first();

        if (!empty($previousResult)) {
            if ($previousResult->finish_time->isPast()) {
                if (!isset($previousResult->point)) {
                    $this->calculateAndSaveFinalAnswer($exam,$previousResult);
                }
                return false;
            }
        }
        return true;
    }

}
