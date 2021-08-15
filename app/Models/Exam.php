<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable =
    [
    'name',
    'description',
    'start_date',
    'end_date',
    'duration',
    'total_marks',
    'default_mark',
    'negative_mark',
    'publish_result',
    'instruction',
    'status',
    'user_attended',
    'randomise_questions',
    'attend_negative_marking'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_date',
        'end_date'
    ];
    // protected $casts = [
    //     'end_date' => 'datetime',
    // ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('result_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }



}
