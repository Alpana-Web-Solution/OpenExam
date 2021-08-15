<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsCollection;
//using tenent for result so it automatically fill user_id and get only users result
use App\Traits\Multitenantable;

class Result extends Model
{
    use HasFactory;
    use Multitenantable;

    protected $fillable = [
        'exam_id',
        'user_id',
        'answers',
        'time',
        'point',
        'finish_time'

    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'finish_time',
    ];

    protected $casts = [
    	// Casting json->array and return normally.
        'answers' => AsCollection::class,
        'time'=> AsCollection::class
    ];

    public function exam()
    {
        return $this->hasOne(Exam::class,'id','exam_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function answers()
    {
       return $this->hasMany(ResultAnswer::class,'result_id','id');
    }
    public function questions()
    {
        return $this->hasOne(ExamResultQuestionOrder::class);
    }

}
