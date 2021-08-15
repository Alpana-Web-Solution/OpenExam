<?php
/**
     * This is a temp table where question and answer will be saved.
     *
     */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultAnswer extends Model
{
    use HasFactory;

    protected $fillable =[
    'result_id',
    'question_id',
    'answer',
    'skipped',
    'time'
    ];

    public function result()
    {
        return $this->hasOne(Result::class);
    }

}
