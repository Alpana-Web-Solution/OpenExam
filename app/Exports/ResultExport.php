<?php

namespace App\Exports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResultExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $examID;

    public function __construct($id)
    {
        $this->examID = $id;
    }

    public function collection()
    {
        return Result::where('exam_id',$this->examID)
        ->select(['user_id','point','percentage'])
        ->orderBy('point','desc')
        ->with('user')
        ->get();

    }
    public function headings(): array
    {
        return [
            'Name',
            'Point',
            '%',
        ];
    }

    public function map($result): array
    {
        return [
            $result->user->name,
            $result->point,
            $result->percentage,
        ];
    }
}
