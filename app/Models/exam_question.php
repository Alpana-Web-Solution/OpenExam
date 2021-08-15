<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class exam_question extends Pivot
{
    //
    protected $fillable=['exam_id','question_id'];
}
