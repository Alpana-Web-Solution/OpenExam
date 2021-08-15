<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;

class QuestionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //  Currently supported only mcq
            $type = 1;
            $subject_id = request()->subject_id;
            $point = request()->point;
            $difficulty = request()->difficulty;

            return new Question([
                'question'=>$row[0],
                'options'=>array('1'=>$row[1],'2'=>$row[2],'3'=>$row[3],'4'=>$row[4]),
                'answer'=>$row[5],
                'subject_id'=>$row[6] ?? $subject_id,
                'point'=>$row[7] ?? $point,
                'difficulty'=>$row[8] ?? $difficulty,
                'help'=>$row[9] ?? null,
                'media'=>$row[10] ?? null,
                'type'=>$row[11] ?? $type,

            ]);
    }
}

// 'question','options','answer','subject_id','point','difficulty','help','media'
