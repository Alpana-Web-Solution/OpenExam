<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;


class ExamResultQuestionOrder extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
    'result_id',
    'questions'
    ];

    protected $casts = [
    	// Casting json->array and return normally.
        'questions' => AsCollection::class,
    ];

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

}
