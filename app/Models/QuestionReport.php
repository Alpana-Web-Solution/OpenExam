<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Multitenantable;

class QuestionReport extends Model
{

    use HasFactory;
    use Multitenantable;

    protected $fillable = [
        'question_id',
        'user_id',
        'result_id',
        'replay',
        'status',
        'report'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function question()
    {
        return $this->hasOne(Question::class,'id','question_id');
    }

}
