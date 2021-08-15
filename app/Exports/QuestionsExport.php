<?php

namespace App\Exports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\FromCollection;

class QuestionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $array =[];
        $getData = Question::select([
            'question',
            'options->1',
            'options->2',
            'options->3',
            'options->4',
            'answer',
            'subject_id',
            'point',
            'difficulty',
            'help',
            'media'
            ])
            ->get();
        return $getData;

    }
}
